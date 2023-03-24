const http = require('http');
const fs = require('fs');
const url = require('url');
const querystring = require('querystring');

const server = http.createServer((req, res) => {
  const pageUrl = url.parse(req.url, true);
  const pathname = pageUrl.pathname;
  console.log(pathname);
  //Login Page
  if (pathname === '/') {
    fs.readFile('index.html', (err, data) => {
      if (err) {
        res.writeHead(404, { 'Content-Type': 'text/html' });
        res.write('<h1>404 Not Found</h1>');
        return res.end();
      }
      res.writeHead(200, { 'Content-Type': 'text/html' });
      res.write(data);
      return res.end();
    });

    } else if (pathname === '/styles.css') {
        fs.readFile('style.css', (err, data) => {
        if (err) {
            res.writeHead(404, {'Content-Type': 'text/html'});
            return res.end('404 Not Found');
        }
        res.writeHead(200, {'Content-Type': 'text/css'});
        res.write(data);
        return res.end();
    });

  // Fuel Quote Form Page
  } else if (pathname === '/fuel_quote_form.html') {
      fs.readFile('fuel_quote_form.html', (err, data) => {
        if (err) {
          res.writeHead(404, { 'Content-Type': 'text/html' });
          return res.end('404 Not Found');
        }
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.write(data);
        return res.end();
      });

    } else if (pathname === '/fuel_quote_form.css') {
      fs.readFile('fuel_quote_form.css', (err, data) => {
        if (err) {
          res.writeHead(404, { 'Content-Type': 'text/html' });
          return res.end('404 Not Found');
        }
        res.writeHead(200, { 'Content-Type': 'text/css' });
        res.write(data);
        return res.end();
      });

  // Create Account Page
  } else if (pathname === '/Create_Account.html') {
    fs.readFile('Create_Account.html', (err, data) => {
      if (err) {
        res.writeHead(404, { 'Content-Type': 'text/html' });
        res.write('<h1>404 Not Found</h1>');
        return res.end();
      }
      res.writeHead(200, { 'Content-Type': 'text/html' });
      res.write(data);
      return res.end();
    });

  } else if (pathname === '/Create_Account.css') {
    fs.readFile('Create_Account.css', (err, data) => {
      if (err) {
        res.writeHead(404, { 'Content-Type': 'text/html' });
        return res.end('404 Not Found');
      }
      res.writeHead(200, { 'Content-Type': 'text/css' });
      res.write(data);
      return res.end();
    });

  // Image files
    } else if (pathname.match(/\.(png|jpg|jpeg|gif|ico)$/)) {
        const imagePath = '.' + pathname;
        const imageType = pathname.split('.').pop();
        const contentType = 'image/' + imageType;
        
        fs.readFile(imagePath, (err, data) => {
          if (err) {
            res.writeHead(404, { 'Content-Type': 'text/html' });
            return res.end('404 Not Found');
          }
          res.writeHead(200, { 'Content-Type': contentType });
          res.write(data);
          return res.end();
        });
        
  } else if (pathname === '/login') {
    let body = '';
    req.on('data', (chunk) => {
      body += chunk.toString();
    });
    req.on('end', () => {
      const formData = querystring.parse(body);
      const username = formData.username;
      const password = formData.password;

      // Validate username and password
      if (username === 'admin' && password === 'password') {
        res.writeHead(302, { 'Location': '/fuel_quote_form.html' });
        return res.end();
      } else {
        fs.readFile('index.html', (err, data) => {
          if (err) {
            res.writeHead(404, { 'Content-Type': 'text/html' });
            res.write('<h1>404 Not Found</h1>');
            return res.end();
          }

          res.writeHead(200, { 'Content-Type': 'text/html' });
          res.write('<p>Incorrect username or password. Please try again.</p>');
          res.write(data);
          return res.end();
        });
      }
    });
  }
});

const port = 3000;
server.listen(port, () => {
  console.log(`Server running at http://localhost:${port}/`);
});