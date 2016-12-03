# DBProject
CS 202 project using MySQL, php. 

## due date: 16/12/2016


## Requirements

• Each user first register to the system by a unique username.
```
USER(username, reservation_id, password);
```
*Don't forget to check passwords, and make them match*

• Users will login to the system with their own password in order to use the system.
In php use 
```
$sql="SELECT * FROM USER WHERE username='$username'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $username and $password, table row must be 1 row
if($count==1){
    $row = mysql_fetch_assoc($result);
    if (crypt($password, $row['password']) == $row['password']){
        session_register("username");
        session_register("password"); 
        echo "Login Successful";
        return true;
    }
    else {
        echo "Wrong Username or Password";
        return false;
    }
}
else{
    echo "Wrong Username or Password";
    return false;
}
```

• There will be several activities such as theatre, cinema, concert and so on.
```
Activities(activity_id, type,date,city,showroom,available_seats)
```
*Type can be: cinema,theatre,fair etc.*

• The registered user can search the activities according to different search criteria.

o Activities between two given days (e.g., see activities between 10.08.2009 and
20.08.2009)
```
//JS
<script type="text/javascript">
  $(document).ready(function(){
    var CurrentDate=new Date();

    $("#year").val(CurrentDate.getYear());
    $("#month").val(CurrentDate.getMonth());
    $("#day").val(CurrentDate.getDate());
  });
</script>
```
```
//HTML
<select name="year" id="year">
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
</select>

<select name="month" id="month">
  <option value="0">January</option>
  <option value="1">February</option>
  <option value="2">March</option>
  <option value="3">April</option>
  <option value="4">May</option>
  <option value="5">June</option>
  <option value="6">July</option>
  <option value="7">August</option>
  <option value="8">September</option>
  <option value="9">October</option>
  <option value="10">November</option>
  <option value="11">December</option>
</select>

<select name="day" id="day">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>
```

o Activities according to their type (e.g., cinema, theatre)
```
"SELECT * FROM Activities WHERE type='$type'"
```
o Activities according to their city (e.g., activities in Istanbul)
```
"SELECT * FROM Activities WHERE city='$city'"
```
o Activities according to their showroom (e.g., Cemil Topuzlu AcikhavaSahnesi)
```
"SELECT * FROM Activities WHERE showroom='$showroom'"
```
o And combinations of these above search conditions (e.g. search for a particular
activity in a given city, which holds in specified dates)
```
"SELECT * FROM Activities WHERE showroom='$showroom' AND city='$city'"
```

• Note that the user can select these conditions together, or separately. For instance, the
user can specify the date and activity type or she can specify date, activity type and
city. There may be a number of combinations.

*If not entered, we directly assume it is “*”. For example*
*$type = "*";*
*$date = "*";*
*$city = "*";*
*$showroom = "*";*

*take user input afterwards, if they don’t enter anything just use *.*

```
SELECT * FROM Activities WHERE type='$type' AND date='$date' AND city='$city' AND
showroom='$showroom'
```

• The user can make reservation to a specific activity by specifying the number of
tickets to be issued.
- Create a view called user and let them change the reservation database only.
```
Reservation(reservation_id, activity_id, number_of_tickets); 
Activities(activity_id, type,date,city,showroom,available_seats); 
USER(username, reservation_id, password);
```
- Do remember to check available_seats while making reservations

• The user can update his/her reservation by only changing the number of tickets to be
issued.
```
UPDATE Reservation SET number_of_tickets=$new_number_of_tickets 
```
• The user can cancel his reservation (s).
```
DELETE FROM  Reservation INNER JOIN User ON user.reservation_id = reservation.reservation_id WHERE user.reservation_id = $cancel_id
```
• The user can list or view his all reservation information.
```
SELECT * FROM Activity WHERE activity.activity_id = reservation.activity_id
```