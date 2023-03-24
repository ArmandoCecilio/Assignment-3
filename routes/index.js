var express = require('express');
var router = express.Router();
var companyname='Oleum';
/* Home Page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: companyname +'- Login' , companyname:companyname});
});

//Quotehistory Router.
router.get('/quotehistory', function(req, res, next) {
  //Dummy quotes to populate from.
  let useraddress="7541 Dunvale Rd, Houston, TX 77063";
  let userquotes= Array(
    {quoteid:1, gallons:10, address:useraddress, date:"Nov 22, 2022", price:1.5, totalcost:15},
    {quoteid:2, gallons:12, address:useraddress, date:"Nov 29, 2022", price:1.4, totalcost:16.8},
    {quoteid:3, gallons:9, address:useraddress, date:"Dec 2, 2022", price:1.35, totalcost:12.15},
    {quoteid:4, gallons:10, address:useraddress, date:"Jan 12, 2023", price:1.3, totalcost:13}
  );
  res.render('quotehistory', { title: companyname + '- Login', companyname:companyname, userquotes:userquotes, useraddress:useraddress});
});
//End Quotehistory.


module.exports = router;
