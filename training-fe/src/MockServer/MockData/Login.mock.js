export const userSuccessfulLogin = {
    status: 200,
    message: "Logged in successfully",
    data: {
        expireTime: "time",
        jwtToken: "test",
    },
};

export const userUnsuccessfulLogin = {
    status: 400,
    message: "Invalid username or password",
    data: null,
};