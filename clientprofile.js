// For Client Profile Management module section.
const http = require('http');
const url = require('url');
const fs = require('fs');
const path = require('path');

const server = http.createServer((req, res) => 
{
 const reqUrl = url.parse(req.url);
  if (reqUrl.pathname === '/') {
    fs.readFile('ClientProfile.html', (err, data) => {
      if (err) {
        res.writeHead(500, { 'Content-Type': 'text/html' });
        res.end('<h1> 500: Internal Server Error </h1>');
      } else {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(data);
      }
    });
  } else if (reqUrl.pathname === '/ClientProfile.css') 
  {
    const mainCSSPathfinder = path.join(__dirname, '/ClientProfile.css');
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
  } else if (req.method === 'POST' && reqUrl.pathname === '/profile')
  {
    let body = '';
    req.on('data', chunk => {
      body += chunk.toString();
   });
    req.on('end', () => {
     const formData = JSON.parse(body);
      
      // To able to validate form data section. 
     if (!formData.fullname || formData.fullname.length > 50) 
      {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid full name');
      } else if (!formData.address1 || formData.address1.length > 100) {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid address 1');
      } else if (formData.address2 && formData.address2.length > 100) {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid address 2');
      } else if (!formData.city || formData.city.length > 100) {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid city');
      } else if (!formData.state || formData.state.length !== 2) {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid state');
      } else if (!formData.zipcode || formData.zipcode.length < 5 || formData.zipcode.length > 9) {
        res.writeHead(400, { 'Content-Type': 'text/plain' });
        res.end('Invalid zipcode');
      } else {
        // This is to save the form data. 
       res.writeHead(200, { 'Content-Type': 'text/plain' });
       res.end('Profile updated successfully');
      }
    });
  } else {
   res.writeHead(404, { 'Content-Type': 'text/plain' });
   res.end('Page not found');
  }
});
// This is for the server to listen. 
server.listen(3000, () => {
console.log('Server is running on port 3000');
});
