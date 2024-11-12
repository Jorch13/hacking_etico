const { verifyToken } = require('../utils/jwt');

const authMiddleware = (req, res, next) => {
  const token = req.headers['authorization'];

  if (!token) {
    return res.status(403).send('Token requerido');
  }

  const decoded = verifyToken(token);

  if (!decoded) {
    return res.status(401).send('Token inválido');
  }

  req.user = decoded;
  next();
};

module.exports = authMiddleware;
