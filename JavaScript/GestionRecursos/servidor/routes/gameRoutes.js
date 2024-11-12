const express = require('express');
const { createGame, getGameStatus, updateResources } = require('../controllers/gameController');
const authMiddleware = require('../middlewares/authMiddleware');

const router = express.Router();

// Rutas protegidas por autenticación
router.post('/create', authMiddleware, createGame); // Crear un nuevo juego
router.get('/status', authMiddleware, getGameStatus); // Obtener el estado del juego
router.put('/resources', authMiddleware, updateResources); // Actualizar los recursos

module.exports = router;
