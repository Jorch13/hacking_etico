const Game = require('../models/Game');
const Resource = require('../models/Resource');
const { encrypt, decrypt } = require('../utils/encryption');

// Crear un nuevo juego o continuar con uno existente
const createGame = async (req, res) => {
  try {
    const userId = req.user._id;
    const game = await Game.findOne({ userId });

    if (game) {
      return res.status(200).json(game); // Si ya tiene un juego, devolverlo
    }

    // Si no existe, creamos un juego nuevo con recursos iniciales
    const resources = [
      new Resource({ name: 'Wood', quantity: 100 }),
      new Resource({ name: 'Stone', quantity: 100 }),
      new Resource({ name: 'Food', quantity: 100 })
    ];

    await Resource.insertMany(resources); // Insertar los recursos en la base de datos

    const newGame = new Game({
      userId,
      resources: resources.map(resource => resource._id), // Asociar los recursos al juego
      score: 0
    });

    await newGame.save();

    res.status(201).json(newGame); // Retornamos el juego recién creado
  } catch (err) {
    res.status(500).json({ message: 'Error al crear el juego', error: err });
  }
};

// Obtener el estado del juego y los recursos
const getGameStatus = async (req, res) => {
  try {
    const game = await Game.findOne({ userId: req.user._id }).populate('resources');

    if (!game) {
      return res.status(404).json({ message: 'Juego no encontrado' });
    }

    res.status(200).json(game);
  } catch (err) {
    res.status(500).json({ message: 'Error al obtener el estado del juego', error: err });
  }
};

// Actualizar los recursos (por ejemplo, recolectar más recursos)
const updateResources = async (req, res) => {
  try {
    const { resourceId, amount } = req.body;
    const game = await Game.findOne({ userId: req.user._id }).populate('resources');

    if (!game) {
      return res.status(404).json({ message: 'Juego no encontrado' });
    }

    const resource = game.resources.find(r => r._id.toString() === resourceId);

    if (!resource) {
      return res.status(404).json({ message: 'Recurso no encontrado' });
    }

    // Actualizar la cantidad del recurso
    resource.quantity += amount;

    // Guardar el nuevo valor
    await resource.save();
    res.status(200).json({ message: 'Recurso actualizado con éxito', resource });
  } catch (err) {
    res.status(500).json({ message: 'Error al actualizar el recurso', error: err });
  }
};

module.exports = { createGame, getGameStatus, updateResources };
