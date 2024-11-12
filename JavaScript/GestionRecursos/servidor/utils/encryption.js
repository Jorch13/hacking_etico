const CryptoJS = require('crypto-js');

const encrypt = (data) => {
  const encrypted = CryptoJS.AES.encrypt(data, process.env.ENCRYPTION_KEY).toString();
  return encrypted;
};

const decrypt = (data) => {
  const bytes = CryptoJS.AES.decrypt(data, process.env.ENCRYPTION_KEY);
  const originalData = bytes.toString(CryptoJS.enc.Utf8);
  return originalData;
};

module.exports = { encrypt, decrypt };
