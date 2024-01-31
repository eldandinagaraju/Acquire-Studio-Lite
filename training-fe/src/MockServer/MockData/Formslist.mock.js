export const formDetails = {
    status: 200,
    message: "Success",
    data: [
        {
            "id": 1,
            "title": "Test Form 1",
            "versions": [
                {
                    "versionID": 1,
                    "versionCode": "v0",
                    "isPublished": true
                },
                {
                    "versionID": 2,
                    "versionCode": "v1",
                    "isPublished": false
                },
                {
                    "versionID": 3,
                    "versionCode": "v2",
                    "isPublished": false
                }
            ]
        },
            {
            "id": 2,
            "title": "Test Form 2",
            "versions": [
                {
                    "versionID": 11,
                    "versionCode": "v0",
                    "isPublished": false
                },
                {
                    "versionID": 12,
                    "versionCode": "v1",
                    "isPublished": false
                }
            ]
        },
        {
            "id": 3,
            "title": "Test Form 3",
            "versions": []
        }
    ]
};

export const formsError = {
    status: 401,
    message: "Invalid token",
    data: null
};

export const createFormSuccess = {
    status: 201,
    message: "Form created successfully",
    data: {
      "id": 4
    }
};

export const createFormFailure = {
    status: 400,
    message: "Form title already exists",
    data: null
};

export const updateFormSuccess = {
    status: 200,
    message: "Form title updated successfully",
    data: null
};

export const updateFormFailure = {
    status: 400,
    message: "Form title already exists",
    data: null
};

export const deleteFormSuccess = {
    status: 200,
    message: "Form deleted successfully",
    data: null
};

export const deleteFormFailure = {
    status: 400,
    message: "Form id not found",
    data: null
};

export const addNewVersionSuccess = {
    status: 201,
    message: "Version created successfully",
    data: {
        "id": 1,
        "versionCode": "v3"
    }
};