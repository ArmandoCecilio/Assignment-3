const http = require('http');
const fs = require('fs');
const path = require('path');

// The pricing module for fuel quote form
// Only creating a class and will implement this in last assignment.
class pricingModule {

}

const server = http.createServer((req, res) => {
  if (req.url === '/') {
    fs.readFile('fuel_quote_form.html', (err, data) => {
      if (err) {
        res.writeHead(404, {'Content-Type': 'text/plain'});
        res.end('File not found');
      } else {
        res.writeHead(200, {'Content-Type': 'text/html'});
        res.end(data);
      }
    });
  } else if (req.url === '/fuel_quote_form.css') {
    const cssPath = path.join(__dirname, 'fuel_quote_form.css');
    fs.readFile(cssPath, (err, data) => {
      if (err) {
        res.writeHead(404, {'Content-Type': 'text/plain'});
        res.end('File not found');
      } else {
        res.writeHead(200, {'Content-Type': 'text/css'});
        res.end(data);
      }
    });
  } else {
    res.writeHead(404);
    res.end('Page not found');
  }
});

server.listen(3000, () => {
  console.log('Server running on port 3000');
});

module.exports.pricingModule = pricingModule;
