const express = require('express');
const app = express();
const path = require('path');

app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: true }));

app.set('view engine', 'ejs');

app.get('/', (req, res) => {
  res.redirect('/login');
});

app.get('/login', (req, res) => {
  res.render('login');
});

app.post('/login', (req, res) => {
  const { username, password } = req.body;
  if (username === 'user' && password === 'password') {
    res.redirect('/fuel_quote_form.html'); // redirect to fuel quote form
  } else {
    res.send('Invalid credentials');
  }
});

// Render the create account page when the user visits the /create-account URL
app.get('/Create_Account', function(req, res) {
  res.sendFile(path.join(__dirname + '/Create_Account.html'));
});

app.listen(3000, () => {
  console.log('Server started on port 3000');
});
