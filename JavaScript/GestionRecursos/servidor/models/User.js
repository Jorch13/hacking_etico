const mongoose = require('mongoose');

const UserSchema = new mongoose.Schema({
  username: { type: String, required: true, unique: true },
  hashedPassword: { type: String, required: true }
});

module.exports = mongoose.model('User', UserSchema);
