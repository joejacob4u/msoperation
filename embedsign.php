
<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
$code=$_GET['code'];
include 'conn.php';
$sql="SELECT * FROM `trackingcode` WHERE `code`='$code' LIMIT 1";
$result2=mysql_query($sql);
$result2=mysql_fetch_assoc($result2);
$image=$result2['signature'];
$sql="SELECT * FROM evenement WHERE id='$code'";
$result=mysql_query($sql);
$result=mysql_fetch_assoc($result);
$name=$result['Name'];
//echo $image;
?>
<html lang="en">    
<head>
   
   
    <title>CONTRACT TERMS AND CONDITIONS</title>
</head>
<body>
                                          <h1>CONTRACT TERMS AND CONDITIONS</h1> <br/> 
                                                <h2>WAIVER AND RELEASE AGREEMENT</h2><br/>
Please read carefully
This is a release of liability and a waiver of certain rights
In consideration for receiving certain services from Silverback Moving, INC. ("Company"), I agree to the follOwing Waiver and Release:
I acknowledge that packing, loading. transporting and unloading property creates certain risks to my property and my person. In particular, property car
be broken, dropped, scraped, torn, scratched, lost, etc., including risks to carpets and hardwood flooring, as well as risk of loss of cash, checks, bonds. jewelry,
deeds, coin and stamp collections, alcohol, prescription medications, damages to fur or items lined with fur, particleboard furniture, firearms and/or ammunition,
and plasma televisions. COMPANY STRONGLY RECOMMENDS THAT YOU PERSONALLY MOVE ITEMS OF SIGNIFICANT MONETARY OR PERSONAL
WORTH. Further, I could be physically injured by use of property damaged in the move, or through physical impact with furniture, boxes, or vehicles.
I further understand that transporting home appliances or preparing them for use after transportation is dangerous and could result in injury or damage;
In particular, appliances may be installed improperly and result in flooding, electrocution, or fire. COMPANY STRONGLY RECOMMENDS THAT YOU HIRE A.
PROFESSIONAL SERVICE PROVIDER TO INSTALL ALL APPLIANCES. I acknowledge that installation of home appliances is my personal responsibility and ni
Company's.
I, for myself, my heirs, successors, executors, and subrogates, hereby KNOWINGLY AND INTENTIONALLY WAIVE AND RELEASE, -INDEMNIFY AN1
HOLD HARMLESS COMPANY, it's directors, officers, agents, employees and volunteers from and against any and all claims, actions, causes of action. liabilities
suits, expenses (including reasonable attorneys' fees) for damages to my property or person resulting from COMPANY'S NEGLIGENCE during the move or resulting
from an improperly installed home appliance. Not withstanding, the foregoing, I acknowledge Company is only responsible for $.60 per pound of damaged
or missing items and that I have had the opportunity to seek a higher degree of protection through insurance. I agree that I may not bring any claim for lost or dan
aged items more than nine (9) months after the move. By bringing a claim, I agree to permit Company any reasonable means to investigate my claim. I further
acknowledge that Company is not responsible for the contents of any box it did not pack. And, Company's responsibility only extends to items while under its car(
and custody and terminates when it leaves the premises.
Except when transportation is performed under the provisions of Item 1(b) or tariff, the following Contract Terms and Conditions apply to all transportation performed by carrier in additio
to all other rules, regulations, rates, and charges in this and other applicable tariffs, which are available for inspection at the location(s) specified by the carrier,
This contract is subject to all the rules, regulations, rates and charges in carrier's currently effective applicable tariffs including, but not limited to, the following terms and conditions:
SECTION 1: The carrier or party in possession shall be liable for physical foss of or damage to any articles from external cause while being carried EXCEPT loss. damage or delay
caused by or resulting:
(a) From an act, omission or order of shipper;
(b) From defect or inherent vice of the article, including susceptibility to damage because of atmospheric conditions such as temperature and humidity or changes therein:
(c) From (1) hostile or warlike action in time of peace or war, including action in hindering, combating or defending against an actual, impending or expected attack (A) by anl .
government or sovereign power, or by any authority maintaining or using military, naval or air forces; or (B) by military, naval or air forces; or (C) by an agent of any
such government, power, authority or forces; (2) any weapon of war employing atomic fission or radioactive force whether in time of peace or war; (3)
insurrection, rebellion, revolution, civil war, usurped power, or action taken by governmental authority in hindering, combating, or defending against such an
occurrence; (4) seizure or destruction under quarantine or customs regulations;5) confiscation by order of any government or public authority, or (6) risks of
contraband or illegal transportation or trade.
(d) From terrorist activity, including action in hindering or defending against an actual expected terrorist activity. Such loss or damage is excluded regardless of any other
cause or event that contributes concurrently or in any sequence to the loss. The term 'terrorist activity' means any activity which is unlawful under the laws of the United
States or any State and which involves any of the following: (1) the hijacking or sabotage of any conveyance (including an aircraft, vessel, cab, truck, van, trailer,
container or vehicle) or warehouse or other building; (2) the seizing or detaining, and threatening to kill, injure, or continue to detain, another individual in order to
compel a third person (including an governmental organization) to do or abstain from doing any act as an explicitly or implicit condition for the release of the
individual seized or detained; (3) an assassination; (4) the use of any (A) biological agent, chemical agent, or nuclear weapon or device, or (B) explosive, firearm, or
other weapon or dangerous device (other than for mere personal monetary gain), with intent to endanger, directly or indirectly, the safety of one or more
individuals or to cause substantial damage to property; or (5) a threat, attempt, or conspiracy to do any of the foregoing.
(e) From delay caused by strikes, lockouts, labor disturbances, riots, civil commotions, or the acts of any person or persons taking part in any such
occurrence or disorder, and from loss or damage when carrier, after notice to shipper or consignee of a potential risk of loss or damage to the
shipment from such causes, is instructed by the shipper to proceed with such transportation and/or delivery, notwithstanding such risk.
(f) From Acts of God.
SUBJECT, in addition to the foregoing, to the further following limitations on the carrier's or the party's in possession liability; The carrier's or the party's in possession maximum liability
shall be The actual loss or damage not exceeding sixty (60) cents per pound of the weight of any lost or damaged article when the shipper has released the shipment to carrier, in writing,
with liability limited to sixty (60) cents per pound per article, or
SECTION 2: The carrier shall not be liable for delay caused by highway obstruction, or faulty or impassable highways, or lack of capacity of any highway, bridge or ferry, or caused by
breakdown or mechanical defect of vehicles or equipment, or from any cause other than negligence of the carrier; nor shall the carrier be bound to transport by any particular schedule,
means, vehicle or otherwise than with reasonable dispatch. Every carrier shall have the right in case of physical necessary to forward said property by any carrier or route between the
point of shipment and the point of destination.
SECTION 3:
(a) The shipper, upon tender of the shipment to carrier, and the consignee, upon acceptance of delivery of shipment from carrier, shall be liable, jointly and severally, for all
unpaid charges payable on account of a shipment In accordance with applicable tariffs including, but not limited to, sums advanced or disbursed by a carrier on
account of such shipment. The extension of credit to either shipper or consignee for such unpaid charges shall not thereby discharge the obligation of the other
party to pay such charges in the event the party to whom credit has been extended shall fail to pay such charges.
(b) The shipper shall indemnify carrier against loss or damage caused by inclusion in the shipment of explosives or dangerous articles or goods.
SECTION 4: If for any reason other than the fault of carrier, delivery cannot be made at address shown on the face hereof, or at any changed address of which carrier has been notified,
carrier, at its option. may cause articles contained in shipments to be stored In a warehouse selected by it at the point of delivery or at other available points, at the cost of the
owner, and subject to a lien for all accrued tariff charges.
SECTION 5: If shipment is refused by consignee at destination, or if shipper, consignee or owner of property fails to receive or claim it within fifteen (15) days after written notice by
United States mail addressed to shipper and consignee at post office addresses shown on face thereof, or if shipper fails or refuses to pay applicable charges in accordance with carrier'
applicable tariff, carrier may sell the property at its option, either (a) upon notice in the manner authorized by law..or (b) at public auction to highest bidder for cash at a public sale to be
held at a time and place named by carrier, thirty (30) days notice of which sale shall have been given in writing to shipper and consignee, and there shall have been published at least
once a week for two consecutive weeks in a newspaper of general circulation at or near the place of sale, a notice thereof containing a description of the property a§ described in the bill
of lading, and the names of the consignor and consignee. The proceeds of any sale shall be applied toward payment of tariff charges applicable to shipment and toward expenses of
notice, advertising and sale, and of storing, caring for and maintaining property prior to sale, and the balance if any shall be paid to owner of property; PROVIDED that any perishable
articles contained in said shipment may
be sold at public or private sale without such notices, if, in the opinion of carrier, such action is necessary to prevent deterioration or further deterioration.
SECTION 6: As a condition precedent to recovery, a claim for any loss or damage, injury or delay, must be filed in writing with carrier within nine (9) months after delivery to consignee a
shown on face hereof, or in case of failure to make delivery, then within nine (9) months after a reasonable time
for delivery has elapsed; and suit must be instituted against carrier within two (2) years and one (1) day from the date when notice in writing is given by carrier to the claimant that carrier
has disaflowed the claim or any part or parts thereof specified in the notice. Where a claim is not filed or suit is not instituted thereon in accordance with the foregoing provisions, carrier
shall not be liable and such a claim will not be paid
Any and All claims and/or legal actions between the parties to this contract shall be brought in the Courts of the City of Birmingham and the County of Oakland,
Michigan - it is agreed that these Courts are the ONLY proper venue for any legal action between the parties and the parties so confirm.

<br/><br/>
<b><?php echo $name;?></b><br/>
Signature:<br/>
<?php

echo '<img id="my_image" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>';
?>
 <br/><b><?php echo $result2['signstamp'];?></b>
</body>
</html>

