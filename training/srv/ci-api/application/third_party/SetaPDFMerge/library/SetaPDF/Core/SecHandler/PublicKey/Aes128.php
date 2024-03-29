<?php
/**
 * This file is part of the SetaPDF-Core Component
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage SecHandler
 * @license    https://www.setasign.com/ Commercial
 * @version    $Id: Aes128.php 1199 2018-03-05 15:27:17Z jan.slabon $
 */

/**
 * Generator class for AES 128 bit public-key security handler
 *
 * @copyright  Copyright (c) 2018 Setasign - Jan Slabon (https://www.setasign.com)
 * @category   SetaPDF
 * @package    SetaPDF_Core
 * @subpackage SecHandler
 * @license    https://www.setasign.com/ Commercial
 */
class SetaPDF_Core_SecHandler_PublicKey_Aes128 extends SetaPDF_Core_SecHandler_PublicKey
{
    /**
     * Factory method for AES 128 bit public-key security handler.
     *
     * @param SetaPDF_Core_Document $document
     * @param SetaPDF_Core_SecHandler_PublicKey_Recipient[]|SetaPDF_Core_SecHandler_PublicKey_Recipient $recipients
     * @param boolean $encryptMetadata
     * @throws SetaPDF_Core_SecHandler_Exception
     * @return SetaPDF_Core_SecHandler_PublicKey_Aes128
     */
    static public function factory(
        SetaPDF_Core_Document $document,
        $recipients,
        $encryptMetadata = true
    )
    {
        if (!is_array($recipients)) {
            $recipients = array($recipients);
        }

        $encryptionDict = new SetaPDF_Core_Type_Dictionary();
        $encryptionDict->offsetSet('Filter', new SetaPDF_Core_Type_Name('Adobe.PubSec', true));
        
        $encryptionDict->offsetSet('V', new SetaPDF_Core_Type_Numeric(4));
        $encryptionDict->offsetSet('SubFilter', new SetaPDF_Core_Type_Name('adbe.pkcs7.s5', true));
        $encryptionDict->offsetSet('Length', new SetaPDF_Core_Type_Numeric(128));
        
        $encryptionDict->offsetSet('EncryptMetadata', new SetaPDF_Core_Type_Boolean($encryptMetadata));
        
        $cf = new SetaPDF_Core_Type_Dictionary();
        $stdCf = new SetaPDF_Core_Type_Dictionary();
        $stdCf->offsetSet('CFM', new SetaPDF_Core_Type_Name('AESV2', true));
        $stdCf->offsetSet('AuthEvent', new SetaPDF_Core_Type_Name('DocOpen', true));
        $stdCf->offsetSet('Length', new SetaPDF_Core_Type_Numeric(128));
        $cf->offsetSet('DefaultCryptFilter', $stdCf);
        $encryptionDict->offsetSet('CF', $cf);
        $encryptionDict->offsetSet('StrF', new SetaPDF_Core_Type_Name('DefaultCryptFilter', true));
        $encryptionDict->offsetSet('StmF', new SetaPDF_Core_Type_Name('DefaultCryptFilter', true));

        $_recipients = new SetaPDF_Core_Type_Array();
        $stdCf->offsetSet('Recipients', $_recipients);
        $stdCf->offsetSet('EncryptMetadata', new SetaPDF_Core_Type_Boolean($encryptMetadata));

        $instance = new self($document, $encryptionDict);
        if (version_compare(phpversion(), '5.4', '>=')) {
            $instance->setCipherId(OPENSSL_CIPHER_AES_128_CBC);
        } else {
            $instance->setCipherId(OPENSSL_CIPHER_RC2_128);
        }

        // create a 20byte seed
        $seed = $instance->generateRandomBytes(20);
        $envelopes = $instance->_prepareEnvelopes($recipients, $seed);

        $encryptionKey = $instance->_computeEncryptionKey($envelopes, $seed, $encryptMetadata);

        foreach ($envelopes AS $envelope) {
            $_envelope =  new SetaPDF_Core_Type_String($envelope);
            $_envelope->setBypassSecHandler();
            $_recipients[] = $_envelope;
        }

        $instance->_encryptionKey = $encryptionKey;
        $instance->_auth = true;
        $instance->_authMode = SetaPDF_Core_SecHandler::OWNER;

        return $instance;
    }
}