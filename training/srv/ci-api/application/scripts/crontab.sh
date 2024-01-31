# 
5 * * * * cd /var/www/html && php index.php cronjobs calculate_user_activity_for_challenges >  /dev/null

# Update user_challenges from  not_started to started when it's the user_timezone
1,30 * * * * cd /var/www/html && php index.php cronjobs update_user_challenge_status_when_a_challenge_starts_for_all_users >  /dev/null

# Two days after registration and they still don't have a device synced.
0 */4 * * cd /var/www/html && php index.php cron notConnectedDevice >  /dev/null

# Sending notifications to users about available challenges
0,30 * * * * cd /var/www/html && php index.php cronjobs notify_user_with_available_challenge

# User who connects Facebook
*/15 * * * * cd /var/www/html && php index.php cron whoConnectedFacebook >  /dev/null

# User has connected scale but hasn't logged weight by day 6 of the current week in the last 5 days.
0 */2 * * * cd /var/www/html && php index.php cron notLoggedWeight >  /dev/null

# User has sufficient points for a redemption.
0 */1 * * * cd /var/www/html && php index.php cron userRedemptions >  /dev/null

# User has no personal goal set AND have a device connected
0 */5 * * * cd /var/www/html && php index.php cron noPersonalGoalWithDeviceConnected >  /dev/null

# Update user_challenges from  not_started to started when it's the user_timezone
#0 /6 * * cd /var/www/html && php index.php cron trackUsersStopLogging >  /dev/null

# All Facebook life event trigger notifications single,engaged,married etc
0 */2 * * * cd /var/www/html && php index.php notifications_cron fbNotifications >  /dev/null

# User has not taken poll
0 */2 * * * cd /var/www/html && php index.php notifications_cron pollNotifications >  /dev/null

# User has not taken quiz
0 */2 * * * cd /var/www/html && php index.php notifications_cron quizNotifications >  /dev/null

# User has not viewed video
0 */2 * * * cd /var/www/html && php index.php notifications_cron videoNotifications >  /dev/null

# User has not taken pre-survey
0 */2 * * * cd /var/www/html && php index.php notifications_cron preSurveyNotifications >  /dev/null

# User has not taken the post-survey
0 */2 * * * cd /var/www/html && php index.php notifications_cron postSurveyNotifications >  /dev/null

# Updating scheduled status pendin to success If notifications sent to all users.
0 0 * * * cd /var/www/html && php index.php engagementcrons scheduleNotificationsUpdate >  /dev/null

# Sending push,messages and email to users for triggers
1,30 * * * * cd /var/www/html && php index.php engagementcrons triggerNotifications >  /dev/null

# Sending push,messages and email to users who met the date and time conditions for scheduled campaigns
*/15 * * * * cd /var/www/html && php index.php engagementcrons index >  /dev/null

# Tango Remaining balance updates and sending email to below 1k and 5k
0 0 * * * cd /var/www/html && php index.php cron tangoRemainingBalance >  /dev/null

# Here we are fetching all users life event posts for every 24 hours
* 0 * * * cd /var/www/html && php index.php cron fetchDailyFBPosts >  /dev/null

# Inserting/Deleting the users who meet the tag conditions.
* 0 * * * cd /var/www/html && php index.php cron taggedUsersUpdate >  /dev/null

# Update audience segmentation for content
0 */12 * * * cd /var/www/html && php index.php cronjobs update_users_for_audience_segmentation >  /dev/null

# Update challenges_retrospective for users
0 2 * * * cd /var/www/html && php index.php cronjobs update_challenges_retrospective >  /dev/null

# Allocate bonus points for community challenge for users
30 * * * * cd /var/www/html && php index.php cronjobs allocate_bonus_points_for_community_challenges >  /dev/null

# Update user rank for challenge stage for users
25 * * * * cd /var/www/html && php index.php cronjobs update_user_rank_for_a_challenge_stage >  /dev/null

# imported users cron (insert and update)
*/30 * * * * cd /var/www/html && php index.php imported_users_cron users >  /dev/null

# imported policies cron  (insert and update)
*/30 * * * * cd /var/www/html && php index.php imported_users_cron policies >  /dev/null