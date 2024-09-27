const venom = require('venom-bot');
const express = require('express');
const app = express();
const port = 3000;

app.use(express.json()); // Para interpretar JSON

let clientVenom;

// Inicializar o Venom Bot
venom
  .create()
  .then((client) => {
    clientVenom = client;
    console.log('Venom Bot iniciado!');
  })
  .catch((erro) => {
    console.log(erro);
  });

// Rota para enviar mensagem via Venom Bot
app.post('/send-message', (req, res) => {
  const { message } = req.body;
  const number =  5547999762985;
  // Verificar se o Venom Bot está pronto
  if (!clientVenom) {
    return res.status(500).json({ error: 'Venom Bot ainda não está pronto' });
  }

  // Enviar a mensagem usando o Venom Bot
  clientVenom
    .sendText(`${number}@c.us`, message)
    .then((result) => {
      res.json({ status: 'success', result });
    })
    .catch((error) => {
      res.status(500).json({ status: 'error', error });
    });
});

// Iniciar o servidor
app.listen(port, () => {
  console.log(`Servidor rodando em http://localhost:${port}`);
});
