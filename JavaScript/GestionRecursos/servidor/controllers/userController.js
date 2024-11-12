const User = require('../models/User');
const { hashSHA256 } = require('../utils/encryption');  // Suponiendo que hashSHA256 es una función de encriptación propia

const registerUser = async (req, res) => {
  try {
    const { username, password } = req.body;
    const hashedPassword = await hashSHA256(password);

    const user = new User({ username, hashedPassword });
    await user.save();

    res.status(201).send('Usuario registrado con éxito');
  } catch (err) {
    res.status(500).send('Error al registrar usuario: ' + err);
  }
};

const loginUser = async (req, res) => {
  const { username, password } = req.body;

  // Aquí iría la lógica de autenticación y la generación de un token JWT
};

module.exports = { registerUser, loginUser };
