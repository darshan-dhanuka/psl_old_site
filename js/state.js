
var handles = ["Andhra Pradesh","Arunachal Pradesh","Bihar","Chandigarh","Chhattisgarh","Dadra and Nagar Haveli","Daman and Diu","Delhi","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka",
                                        "Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Puducherry","Punjab","Rajasthan","Sikkim","Tamil Nadu",
                                        "Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal"];

$(function() {
  var options = '<option value="">Select State *</option>';
  for (var i = 0; i < handles.length; i++) {
      options += '<option value="' + handles[i] + '">' + handles[i] + '</option>';
  }
  $('#listBox').html(options);
});
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
  for (var i = 0; i < city.length; i++) {
      options += '<option value="' + city[i] + '">' + city[i] + '</option>';
  }
  $('#secondlist').html(options);
  });

}