const chai = require('chai');
const chaiHttp = require('chai-http');
const server = require('../server/server');
const User = require('../server/models/User');
const should = chai.should();

chai.use(chaiHttp);

describe('User Authentication', () => {
  beforeEach(async () => {
    // Eliminar usuarios previos antes de cada prueba
    await User.deleteMany({});
  });

  it('should register a new user', (done) => {
    chai.request(server)
      .post('/api/auth/register')
      .send({ username: 'testuser', password: 'password123' })
      .end((err, res) => {
        res.should.have.status(201);
        res.body.message.should.equal('Usuario registrado exitosamente');
        done();
      });
  });

  it('should login an existing user', (done) => {
    const user = new User({ username: 'testuser', hashedPassword: 'password123' });
    user.save().then(() => {
      chai.request(server)
        .post('/api/auth/login')
        .send({ username: 'testuser', password: 'password123' })
        .end((err, res) => {
          res.should.have.status(200);
          res.body.message.should.equal('Autenticación exitosa');
          res.body.token.should.exist;
          done();
        });
    });
  });
});
