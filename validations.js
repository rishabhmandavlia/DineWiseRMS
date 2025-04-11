/*
  Created by IntelliJ IDEA.
  User: CENTILLIONAIRE
  Date: 08-10-2023
  Day:  Sunday
  Time: 07:07 pm
  To change this template use File | Settings | File Templates.
*/

function checkUserName(userName){
    return (/^[a-z]{1}[a-z0-9]{4,14}$/.test(userName));
}

function checkEmail(userEmail){
    const indexOfAtSymbol = userEmail.indexOf('@');
    const substringBeforeAtSymbol = userEmail.slice(0, indexOfAtSymbol).replace(/\./g, '');
    const lengthBeforeAtSymbol = substringBeforeAtSymbol.length;

    return (/^(?=.*[0-9]?)(?=.*[a-zA-Z])(?!.*\.{2,})[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@(gmail\.com|utu\.ac\.in|outlook\.com|yahoo\.com)$/.test(userEmail) && (lengthBeforeAtSymbol >= 6 && lengthBeforeAtSymbol <= 30));
}

function checkContact(userContact){
    return !/^\d{10}$/.test(userContact);
}

function checkPassword(userPassword){
    return /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{6,10}$/.test(userPassword);
}

function checkCity(userCity){
    return !/^[a-zA-Z]{3,30}$/.test(userCity);
}

function checkAddress(userAddress){
    return !/^[a-zA-Z0-9-.,'\n\r ]{10,}$/gm.test(userAddress);
}