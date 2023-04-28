<?php 
function getsugestedprice($conn, $userid, $userstate, $requestedgallons)
{
  $query="SELECT COUNT(*) FROM fuelquoteform WHERE member_ID=$userid";
  $count=$conn->query($query);
  const CurrentPrice=1.50;
  $LocationFactor = $userstate=='TX'?0.02 :0.04;
  $RateHistoryFactor =  $count>0?0.01:0.00;
  $GallonsRequestedFactor = $requestedgallons>1000? 0.02:0.03;
  const CompanyProfitFactor = 0.1;
  $Margin =  CurrentPrice * ($LocationFactor - $RateHistoryFactor + $GallonsRequestedFactor + CompanyProfitFactor);
  
  $SuggestedPrice = CurrentPrice + $Margin;
  return $SuggestedPrice;
}
