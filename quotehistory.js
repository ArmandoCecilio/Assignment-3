// Fuel Quote Module: Quote History.
const http = require('http');
const url = require('url');
const fs = require('fs');
const path = require('path');

const server = http.createServer((req, res) => 
{
 const reqUrl = url.parse(req.url);
  if (reqUrl.pathname === '/quotehistory') {
    fs.readFile('quotehistory.html', (err, data) => {
      if (err) {
        res.writeHead(500, { 'Content-Type': 'text/html' });
        res.end('<h1> 500: Internal Server Error </h1>');
      } else {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(data);
      }
    });
  } else if (reqUrl.pathname === 'quotehistory.css') 
  {
    const mainCSSPathfinder = path.join(__dirname, 'quotehistory.css');
    fs.readFile(mainCSSPathfinder, (err, data) => {
      if (err) 
      {
        res.writeHead(404, { 'Content-Type': 'text/plain'});
        res.end('File not found');
      } else {
        res.writeHead(200, { 'Content-Type': 'text/css' });
        res.end(data);
      }
    });
  }
  else {
   res.writeHead(404, { 'Content-Type': 'text/plain' });
   res.end('Page not found');
  }
});

//This is for the server to listen. 
server.listen(3000, () => {
console.log('Server is running on port 3000');
});
