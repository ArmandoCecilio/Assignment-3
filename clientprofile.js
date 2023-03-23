// For Client Profile Management module section.
const http = require('http');
const url = require('url');
const fs = require('fs');

// Beginning to create the server-side section. 
const server = http.createServer((req, res) => {

  // To start parse the URL side section. 
  const parseUrl = url.parse(req.url, true);

  // To get the pathname of the requested file section. 
  const SectorPath = parseUrl.pathname;

  // To create an if the request is for the home page, return the ClientProfile.html file section. 
  if (SectorPath === '/') 
  {
    fs.readFile('ClientProfile.html', (err, data) => 
    {
      if (err) {
        res.writeHead(500);
        res.end('Error 500: Internal server error');
      } else {
        res.writeHead(200, {'Content-Type': 'text/html'});
        res.end(data);
      }
    });
  }

  // To create an if the request is for the CSS file, return the stylesheet section. 
  else if (SectorPath === '/ClientProfile.css')
  {
    fs.readFile('ClientProfile.css', (err, data) => 
    {
      if (err) {
        res.writeHead(500);
        res.end('Error loading stylesheet');
      } else {
        res.writeHead(200, {'Content-Type': 'text/css'});
        res.end(data);
      }
    });
  }

  // To create an if the request is for any other file, return a 404 error section. 
  else 
  {
    res.writeHead(404);
    res.end('File not found');
  }

});

// To begin the server and listen for incoming requests section. 
server.listen(3000, () => {
  console.log('Server running on port 3000');
});
