function isNumber(str) {
    return /^\+?\d+$/.test(str);
}

function isInteger(value) {
    return typeof value === 'number' && isFinite(value) && Math.floor(value) === value;
}

function checkName(value){
    return /^[A-Z][a-zA-Z ]*$/.test(value);
}

function isValidString(value) {
    // Check if the value is a string and non-empty
    if (typeof value !== 'string' || value.trim().length === 0) {
        return false;
    }

    // Regular expression to match HTML tags and script tags
    var htmlScriptPattern = /<[^>]*>|<\/[^>]*>|<script[^>]*>[\s\S]*?<\/script>/gi;

    // Check if the value contains any HTML or script tags
    return !htmlScriptPattern.test(value);
}

function checkContact(userContact){
    return /^\d{10}$/.test(userContact);
}

function checkPassword(userPassword){
    return /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{6,10}$/.test(userPassword);
}