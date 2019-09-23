<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="google-site-verification" content="vjCj63SGzZo9VFaYBFFn3TWRTrkxfjhe71MmxBB1HCc" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMAGES_PATH?>/favicon-32x32.png">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/owl.carousel.min.css">
     <link rel="stylesheet" href="<?php echo CSS_PATH?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/style.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH?>/inner.css">
</head>
<body>
<?php $this->load->view('header');?>
<section class="subPagebanner">
<div class="">
  <div class="item">
    <div id="loginBanner1" class="imgSlider">
    <div class="container spclftAlgn">
      <div class="bannerMidSec">
          <h2>My Account</h2>
    </div>
    </div>
    </div>
  </div>
</div>
  </section>


<section class="registrationSec">
<form action="" method="post" id="my-account-form">
<div><marquee>*URGENT - Please fill in your DOB and address as per your Identity Card (Aadhar Card, Driving License, Passport or Voter Id). You will be asked to submit/upload the same for verification.</marquee></div>
  <div class="container">
    <div class="row">
    <div class="col-xs-12 text-center">
    <div style="color:green;"><?php if(isset($_GET['msg']) && $_GET['msg']=='succ'){ echo "Your Account Details Updated Successfuly."; } ?></div>
<div style="color:red;"><?php if(isset($_GET['msg']) && $_GET['msg']=='fail'){ echo "Please fill all the information"; } ?></div>
<div style="color:red;"><?php if(isset($_GET['msg']) && $_GET['msg']=='age_err'){ echo "Age restriction of 21 yrs"; } ?></div></div>
      <div class="col-xs-12 col-sm-6">
        <div class="myActTitle"><span>Name</span></div>
        <div class="myActDetails txtfield"><input type="text" disabled="" value="<?php echo $user_info['first_name'].' '.$user_info['last_name']; ?>"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
      <div class="myActTitle"><span>Mobile No.</span></div>
      <div class="myActDetails txtfield"><input type="text" disabled="" value="<?php echo $user_info['mobile']?$user_info['mobile']:'&nbsp;'; ?>"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
      <div class="myActTitle"><span>Age</span></div>
      <?php 

      $dob= $user_info['dob'];
      $age = $dob?(date('Y') - date('Y',strtotime($dob))):'&nbsp;';  ?>
      <div class="myActDetails txtfield"><input type="text" disabled="" value="<?php echo $age; ?>"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
      <div class="myActTitle"><span>Email</span></div>
      <div class="myActDetails txtfield"><input type="text" disabled="" value="<?php echo $user_info['email']?$user_info['email']:'&nbsp;'; ?>"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="myActTitle"><span>Gender</span></div>
        <div class="myActDetails txtfield"><input type="text" disabled="" value="<?php echo $user_info['gender']?$user_info['gender']:'&nbsp;'; ?>"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
      <div class="myActTitle"><span>DOB</span></div>
      <?php  
      $date = '&nbsp';
      if($user_info['dob'] && $user_info['dob']!='0000-00-00')
      {
        $date = date_create($user_info['dob']);
        $date= date_format($date,"d M Y");
      }
      ?>
        <div class="myActDetails txtfield"><input type="text"  name="dob" id="datepicker" readonly="" value="<?php echo $date; ?>" <?php if($user_info['is_modify']==1){ ?>disabled="" <?php } ?> ></div>
      </div>
      <div class="col-xs-12 fullWidth">
        <div class="myActTitle"><span>Address</span></div>
        <div class="myActDetails txtfield"><input type="text" name="address1" id="address1" value="<?php echo $user_info['address1']?$user_info['address1']:'&nbsp;'; ?>" <?php if($user_info['is_modify']==1){ ?>disabled=""<?php } ?>></div>
        <div class="myActDetails txtfield"><input type="text" name="address2" id="address2" value="<?php echo $user_info['address2']?$user_info['address2']:'&nbsp;'; ?>" <?php if($user_info['is_modify']==1){ ?>disabled=""<?php } ?>></div>

      </div>

      <div class="col-xs-12 col-sm-6">
        <div class="myActTitle"><span>State</span></div>
        
        <div class="myActDetails txtfield">
        <?php if($user_info['is_modify']==1){ ?>
          <input type="text" disabled="" value="<?php echo $user_info['state']?$user_info['state']:'&nbsp;'; ?>">
        <?php }else{ ?>
          <select id="listBox" name="state" class="state" onchange='selct_district(this.value)' ></select>
        <?php } ?>
       
        </div>
        </div>
      <div class="col-xs-12 col-sm-6">
        <div class="myActTitle"><span>City</span></div>

         <div class="myActDetails txtfield">
          <?php if($user_info['is_modify']==1){ ?>
          <input type="text" disabled="" value="<?php echo $user_info['city']?$user_info['city']:'&nbsp;'; ?>">
          <?php }else{ ?>
            <select id='secondlist' name="city" class="city" ><option value="">Select city</option></select>
          <?php } ?>
          </select>
        </div>
      </div>
      <div class="clr"></div>
      <?php if($user_info['is_modify']==0){ ?>
      <div class="mobsetBtn txtfield col-xs-7 col-sm-5 col-md-4 nofloat">
       <button type="submit" class="btn customBtn" onclick="updateMyAccount(event);">update</button>
      </div>
      <?php } ?>
<!--       <div class="col-xs-12 col-sm-6">
        <div class="myActTitle"><span>Password</span></div>
        <div class="myActDetails"><span>******</span>
          <a href="javascript:;" class="clickingBtn">Change</a>
        </div>
      </div> -->
      </div>
    </div> 
    </div>
    </form>
    <div class="container">
    <div class="row">
    <div class="col-xs-12">
  <?php if($user_info['doc_status']=='not submitted'){ ?>
  <div class="text-center mrBtm15">Please submit your address proof corresponding to the address and DOB filled above.</div>
  <div class="text-center mrBtm15">
    <p class="docerrorMsg globleRed"><?php echo isset($doc_err_msg)?$doc_err_msg:''; ?></p>
  </div>
 <form action="" method="post" id="upload-doc-form" enctype="multipart/form-data">
  <div class="txtfield myActDtl col-md-3 col-sm-4 col-xs-12">
  <?php $doc_type = (isset($_POST['doc_type'])&&$_POST['doc_type'])?$_POST['doc_type']:0; ?>
    <select name="doc_type" id="doc_type">
      <option value="">Select Proof</option>
      <?php foreach($doc_type_arr as $row){ ?>
      <option value="<?php echo $row['id']; ?>" <?php if($doc_type==$row['id']){ ?>selected <?php } ?>><?php echo $row['doc_name']; ?></option>
      <?php } ?>
      </select></div>
  <div class="txtfield myActDtl col-md-6 col-sm-5 col-xs-12">
  <input type="text" disabled="" id="uploadFile" placeholder="Please upload 2MB file in .pdf, .doc, or .jpg format">
  <input type="file" name="userfile" value="" id="userfile" >
  </div>
  <div class="txtfield myActDtl col-sm-3 col-xs-12"><button type="submit" class="btn customBtn" onclick="uploadDoc(event);">SUBMIT</button></div>
  </form>
  <?php }else{ ?>
  <div class="text-center mrBtm15">
    <p class="docsuccMsg globlegreen"><?php if($_GET['msg']=='success'){ echo "File Uploaded Successfully.";} ?></p>
  </div>
  <div class="txtfield myActDtl col-md-3 col-sm-4 col-xs-12">
    <select name="doc_type" id="doc_type" disabled="">
      <option value="">Select Proof</option>
      <?php foreach($doc_type_arr as $row){ ?>
      <option value="<?php echo $row['id']; ?>" <?php if($row['doc_name']==$user_info['doc_name']){ ?> selected <?php } ?>><?php echo $row['doc_name']; ?></option>
      <?php } ?>
      </select></div>
  <div class="txtfield myActDtl col-md-6 col-sm-5 col-xs-12">
  <input type="text" disabled="" value="<?php echo $user_info['doc_status']; ?>" id="uploadFile">
  </div>
  <?php } ?>
  </div>
  </div>
  </div>
</section>

<div class="profilePopup">
<div class="overlay"></div>
<div class="popupContent">
  <div class="closeBtn">x</div>
  <div class="InnerCant errPopUP text-center">
    <h3 class="globlegreen">Please fill all the information</h3>
    <p></p>
  </div>
  <div class="InnerCant ageErrPopUP text-center">
    <h3 class="globlegreen">Age restriction of 21 yrs</h3>
    <p></p>
  </div>
  <div class="InnerCant confirmPopUP text-center">
    <p>You can Update the information only once. Are you sure you want to ‘Update’? </p>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="$('#my-account-form').submit();">Confirm</a>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="$('.profilePopup').hide();">Cancel</a>
  </div>
  <div class="InnerCant errPopUPDoc text-center">
    <h3 class="globlegreen">Please select document type and file to upload.</h3>
    <p></p>
  </div>
  <div class="InnerCant errPopUPSession text-center">
    <h3 class="globlegreen">Please login again to upload Documents.</h3>
    <p></p>
  </div>
  <div class="InnerCant errPopUPUpdate text-center">
    <h3 class="globlegreen">Please Update your DOB and Address to match the document. </h3>
    <p>If information is correct, just click ‘Update’. </p>
    <p>If you cannot change the information, please mail to info@pokersportsleague.com</p>
  </div>
  <div class="InnerCant confirmDoc text-center">
    <p>You can Update the proof only once. Are you sure you want to ‘Update’? </p>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="$('#upload-doc-form').submit();">Confirm</a>
    <a class="btn customBtn smallBtn" href="javascript:void;" onclick="$('.profilePopup').hide();">Cancel</a>
  </div>

  </div>
</div>

<?php $this->load->view('footer');?>
<script src="<?php echo JS_PATH?>/jquery.min.js"></script>
<script src="<?php echo JS_PATH?>/owl.carousel.js"></script>
<script src="<?php echo JS_PATH?>/jquery-ui.min.js"></script>
<script src="<?php echo JS_PATH?>/main.js"></script>

<script>
  var state_val = '<?php echo $user_info['state']?$user_info['state']:''; ?>';
  var city_val = '<?php echo $user_info['city']?$user_info['city']:''; ?>';

var handles = ["Andhra Pradesh","Arunachal Pradesh","Bihar","Chandigarh","Chhattisgarh","Dadra and Nagar Haveli","Daman and Diu","Delhi","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka",
                                        "Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Puducherry","Punjab","Rajasthan","Sikkim","Tamil Nadu",
                                        "Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal"];

$(function() {
  var options = '<option value="">Select State *</option>';
  var state_flag = '';
    for (var i = 0; i < handles.length; i++) {
      if(handles[i]==state_val)
        state_flag = "selected";
      else
        state_flag = '';
        options += '<option value="' + handles[i] + '" '+state_flag+'>' + handles[i] + '</option>';
    }
  $('#listBox').html(options);
});

  selct_district(state_val);
    

function selct_district($val)
{
  if($val=='Andhra Pradesh'){
    var city = ["Anantapur","Chittoor","East Godavari","Guntur","Krishna","Kurnool","Prakasam","Srikakulam","SriPotti Sri Ramulu Nellore",
                                    "Vishakhapatnam","Vizianagaram","West Godavari","Cudappah"];
  }

  if ($val=='Arunachal Pradesh') {
    var city = ["Anjaw","Changlang","Dibang Valley","East Kameng","East Siang","Kra Daadi","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Namsai","Papum Pare",
                                        "Siang","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang","Upper Dibang Valley"];
  }

  if ($val=='Bihar') {
    var city = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur",
                                        "Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Madhepura","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa",
                                        "Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"];
  }

  if ($val=='Chandigarh') {
    var city = ["Chandigarh"];
  }

  if ($val=='Chhattisgarh') {
    var city = ["Balod","Baloda Bazar","Balrampur","Bastar","Bemetara","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Gariaband","Jashpur","Janjgir-Champa","Kabirdham","Kanker","Kondagaon","Korba","Koriya","Mahasamund",
                                            "   Mungeli","Narayanpur","Raigarh","Rajnandgaon","Raipur","Sukma","Surajpur","Surguja"];
  }
  
  if ($val=='Dadra and Nagar Haveli') {
    var city = ["Amal","Silvassa"];
  }
  
  if ($val=='Daman and Diu') {
    var city = ["Daman","Diu"];
  }
  
  if ($val=='Delhi') {
    var city = ["Delhi","New Delhi"];
  }
  
  if ($val=='Goa') {
    var city = ["North Goa","South Goa"];
  }
  
  if ($val=='Gujarat') {
    var city = ["Ahmedabad","Amreli","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Botad","Chhota Udaipur","Dahod","Dang","Devbhoomi Dwarka",
                                        "Gandhinagar","Gir Somnath","Jamnagar","Junagadh","Kutch","Kheda","Mahisagar","Mehsana","Morbi","Narmada","Navsari","Panchmahal","Patan","Porbandar","Rajkot","Sabarkantha","Surat","Surendranagar","Tapi","Vadodara","Valsad"];
  }
  
  if ($val=='Haryana') {
    var city = ["Ambala","Bhiwani","Faridabad","Fatehabad","Gurgaon","Hisar","Jhajjar","Jind","Kaithal","Karnal",
                                            "Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamuna Nagar"];
  }
  
  
  if ($val=='Himachal Pradesh') {
    var city = ["Bilaspur","Chamba","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul and Spiti","Mandi","Shimla","Sirmaur","Solan","Una"];
  }
  
  if ($val=='Jammu and Kashmir') {
    var city = ["Doda","Jammu","Kathua","Kishtwar","Poonch","Rajouri","Ramban","Reasi","Samba","Udhampur"];
  }
  
  if ($val=='Jharkhand') {
    var city = ["Garhwa","Palamu","Latehar","Chatra","Hazaribagh","Koderma","Giridih","Ramgarh","Bokaro","Dhanbad,","Lohardaga","Gumla","Simdega","Ranchi","Khunti","West Singhbhum","Saraikela Kharsawan","East Singhbhum","Jamtara","Deoghar","Dumka","Pakur","Godda","Sahebganj"];
  }
  
  if ($val=='Karnataka') {
    var city = ["Bagalkot","Bengaluru Urban","Bengaluru Rural","Belagavi","Bellary","Bidar","Chamarajanagar","Chikballapur","Chikkamagaluru","Chitradurga",
                                           "Dakshina Kannada","Davanagere","Dharwad","Gadag","Kalaburagi","Hassan","Haveri","Kodagu","Kolar",
                                           "Koppal","Mandya","Mysuru","Raichur","Ramanagara","Shivamogga","Tumakuru","Udupi","Uttara Kannada","Vijayapura","Yadgir"];
  }
  
  if ($val=='Kerala') {
    var city = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thrissur","Thiruvananthapuram","Wayanad"];
  }
  
  if ($val=='Madhya Pradesh') {
    var city = ["Agar Malwa","Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara",
              "Damoh","Datia","Dhar","Dewas","Dindori","Guna","Gwalior","Indore","Harda","Hoshangabad","Jabalpur","Jhabua","Katni","Khandwa","Khargone","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Raisen","Rajgarh","Ratlam","Rewa",
              "Sagar","Satna","Sehore","Seoni","Shahdol","Shajapur","Sheopur","Shivpuri","Sidhi","Singrauli","Tikamgarh","Vidisha","Ujjain","Umaria"];
  }
  
  if ($val=='Maharashtra') {
    var city = ["Ahmednagar","Akola","Amravati","Aurangabad","Beed","Bhandara","Buldhana","Chandrapur","Dhule","Gadchiroli","Gondia",
                        "Hingoli","Jalgaon","Jalna","Kolhapur","Latur","Mumbai City","Mumbai Suburban","Nagpur","Nanded","Nandurbar","Nashik","Osmanabad",
                        "Parbhani","Pune","Raigad","Ratnagiri","Sangli","Satara","Sindhudurg","Solapur","Thane","Wardha","Washim","Yavatmal","Palghar"];
  }
  
  if ($val=='Manipur') {
    var city = ["Bishnupur","Churachandpur","Chandel","Imphal East","Jiribam","Kakching","Kamjong","Kangpokpi","Noney","Pherzawl","Senapati","Tengnoupal","Tamenglong","Thoubal","Ukhrul","Imphal West"];
  }
  
   if ($val=='Meghalaya') {
    var city = ["Ampati","Baghmara","Jowai","Khliehriat","Mawkyrwat","Nongpoh","Nongstoin","Resubelpara","Shillong","Tura","Williamnagar"];
  }
  
   if ($val=='Mizoram') {
    var city = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Siaha","Serchhip"];
  }
  
   if ($val=='Nagaland') {
    var city = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];
  }
  
  if ($val=='Puducherry') {
    var city = ["Karaikal","Mahe","Puducherry","Yanam"];
  }
  
 if ($val=='Punjab') {
    var city = ["Amritsar","Barnala","Bathinda","Firozpur","Faridkot","Fatehgarh Sahib","Fazilka","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Sri Muktsar Sahib","Pathankot",
                                      "Patiala","Rupnagar","Ajitgarh (Mohali)","Sangrur","Shahid Bhagat Singh Nagar","Tarn Taran"];
  }

  if ($val=='Rajasthan') {
    var city = ["Ajmer","Alwar","Banswara","Baran","Barmer","Bharatpur","Bhilwara","Bikaner","Bundi","Chittorgarh",
                    "Churu","Dausa","Dholpur","Dungarpur","Hanumangarh","Jaipur","Jaisalmer","Jalor","Jhalawar","Jhunjhunu","Jodhpur",
                    "Karauli","Kota","Nagaur","Pali","Pratapgarh","Rajsamand","Sawai Madhopur","Sikar","Sirohi","Sri Ganganagar","Tonk","Udaipur"];
  }
  
  if ($val=='Sikkim') {
    var city = ["Gangtok","Geyzing","Mangan","Namchi"];
  }
  
  
  if ($val=='Tamil Nadu') {
    var city = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri",
              "Madurai","Nagapattinam","Namakkal","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Theni","The Nilgiris",
              "Thoothukudi","Tiruchirappalli","Tirunelveli","Tiruppur","Tiruvallur","Tiruvarur","Tiruvannamalai","Vellore","Viluppuram","Virudhunagar"];
  }
  
  
  if ($val=='Telangana') {
    var city = ["Adilabad","Hyderabad","Jagtial","Jangaon","Jayashankar","Jogulamba","Kamareddy","Karimnagar","Khammam","Komaram Bheem",
    "Mahabubabad","Mahabubnagar","Mancherial","Medak","Medchal","Nagarkurnool","Nalgonda","Nirmal","Nizamabad","Peddapalli","Rajanna","Ranga Reddy","Sangareddy",
    "Siddipet","Suryapet","Vikarabad","Wanaparthy","Warangal Rural","Warangal Urban","Yadadri"];
  }
  
  
  if ($val=='Tripura') {
    var city = ["Agartala","Belonia","Dhalai","Dharmanagar","Gomati","Khowai","Sipahijala","Unakoti"];
  }
  
  
  if ($val=='Uttar Pradesh') {
    var city = ["Agra","Aligarh","Allahabaad","Ambedkar Nagar","Amethi","Amroha","Auraiya","Azamgarh","Bagpat","Bahraich",
              "Balarampur","Ballia","Banda","Barabanki","Bareilly","Basti","Bijnor","Budaun","Bulandshahr","Chandauli","Chitrakoot",
              "Deoria","Etah","Etawah","Faizabad","Farrukhabad","Fatehpur","Firozabad","Gautam Buddha Nagar","Ghazipur","Ghaziabad",
              "Gorakhpur","Gonda","Hamirpur","Hapur","Hardoi","Hathras","Jalaun","Jaunpur","Jhansi","Kannauj","Kanpur Dehat","Kanpur Nagar","Kasganj",
              "Kaushambi","Kushinagar","Lakhimpur Kheri","Lalitpur","Lucknow","Mainpuri","Maharajganj","Mathura","Mahoba","Mau","Meerut","Mirzapur",
              "Moradabad","Muzaffarnagar","Pratapgarh","Pilibhit","Raebareli","Rampur","Saharanpur","Sambhal","Sant Kabir Nagar","Sant Ravidas Nagar",
              "Sitapur","Shahjahanpur","Shamli","Shravasti","Siddharthnagar","Sonbhadra","Sultanpur","Unnao","Varanasi",];
  }
  
  if ($val=='Uttarakhand') {
    var city = ["Almora","Bageshwar","Chamoli","   Champawat","Dehradun","Haridwar","Nainital","Pauri Garhwal","Pithoragarh","Rudraprayag","Tehri Garhwal","Udham Singh Nagar","Uttarkashi"];
  }

  if ($val=='West Bengal') {
    var city = ["Alipurduar","Bankura","Bardhaman","Birbhum","Cooch Behar","Darjeeling","East Midnapore","Hooghly","Howrah",
                                    "Jalpaiguri","Kolkata","Maldah","Murshidabad","Nadia","North 24 Parganas","North Dinajpur","Purulia","South 24 Parganas","South Dinajpur","West Midnapore"];
  }

  $(function() {
  var options = '<option value="">Select City *</option>';

  var city_flag = '';
  for (var i = 0; i < city.length; i++) {
    if(city[i]==city_val)
        city_flag = "selected";
      else
        city_flag = '';
      options += '<option value="' + city[i] + '"  '+city_flag+'>' + city[i] + '</option>';
  }
  $('#secondlist').html(options);
  });

}

</script>


<script>
  $(document).ready(function() {
    var offset = $( '#datepicker' ).offset();
    var gtwidth=$( '#ui-datepicker-div' ).width()
    $("#datepicker").datepicker({
      maxDate: new Date(),
      changeMonth: true,
      changeYear: true,
      //dateFormat: "dd-mm-yy",
      dateFormat: "dd M yy",
      
      yearRange:"c-100:c",
      beforeShow: function(input, inst)
    {
        var gtwidth=$( '#ui-datepicker-div' ).width()

        setTimeout(function () {
          if($(window).width() > 1199){
            inst.dpDiv.css({
                left: offset.left + 42
            });
          }
            if($(window).width() < 1200){
              inst.dpDiv.css({
                left: offset.left - 46
            });
            }
            if($(window).width() < 993){
              inst.dpDiv.css({
                left: offset.left -119
            });
            }
            if($(window).width() < 768){
              inst.dpDiv.css({
                left: offset.left
            });
            }
        }, 0);
    }
    });

 });

  function updateMyAccount(e)
  {
    var dob = $('#datepicker').val();
    var address1 = $('#address1').val();
    var city = $('.city').val();
    var state = $('.state').val();
    $('.profilePopup').show();
    $('.InnerCant').hide();
    if(dob=='' ||dob== undefined ||address1=='' ||address1== undefined||city==''||state=='')
      $('.errPopUP').show();
    else if(dob!='')
    {
      var age = getAge(dob);
      if(age <21)
        $('.ageErrPopUP').show();
      else
        $('.confirmPopUP').show();
    }
    else
      $('.confirmPopUP').show();
    e.preventDefault();
  }

  function getAge(dateString) 
  {
      var today = new Date();
      var birthDate = new Date(dateString);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
      {
          age--;
      }
      return age;
  }

  function uploadDoc(e)
  {
    $('.profilePopup').show();
    $('.InnerCant').hide();
    $.ajax({
          url: '/user/getMyAccountUpdateStatus',
          success: function(response) {
            var resp = $.trim(response);
              if(resp=='0'){
                $('.errPopUPUpdate').show();
              }
              else if(resp=='1')
              {
                var doc_type = $('#doc_type').val();
                var doc = $('#userfile').val();
                if(doc_type=='' || doc=='')
                  $('.errPopUPDoc').show();
                else
                  $('.confirmDoc').show();
              }
              else
                $('.errPopUPSession').show();
            }
        });

    

    e.preventDefault();
  }

  $("#userfile").change(function(){
    $('#uploadFile').val($(this).val().replace(/^.*\\/, ""));
  });

  </script>

</body>
</html>

