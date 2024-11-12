const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const dotenv = require('dotenv');

dotenv.config();

const app = express();

// Conexión a la base de datos
mongoose.connect(process.env.DB_URI, { useNewUrlParser: true, useUnifiedTopology: true })
  .then(() => console.log('Conexión a la base de datos exitosa'))
  .catch(err => console.error('Error de conexión a la base de datos: ', err));

// Middleware para parsear el cuerpo de las solicitudes
app.use(bodyParser.json());

// Rutas
const userRoutes = require('../server/routes/userRoutes');
const gameRoutes = require('../server/routes/gameRoutes');
const authRoutes = require('../server/routes/authRoutes');

app.use('/api/users', userRoutes);
app.use('/api/game', gameRoutes);
app.use('/api/auth', authRoutes);

// Iniciar servidor
app.listen(process.env.PORT, () => {
  console.log(`Servidor en funcionamiento en el puerto ${process.env.PORT}`);
});
