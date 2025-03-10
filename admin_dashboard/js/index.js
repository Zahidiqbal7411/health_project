var slider_table=document.getElementById('slider_table');
var news_table=document.getElementById('news_table');
var marquee_table=document.getElementById('marquee_table');
var admin=document.getElementById('admin_form');
var sub_admin=document.getElementById('sub_admin_form');
var main_content=document.getElementById('main_content');
var form1 = document.getElementById('country_form');
var form2 = document.getElementById('state_form');
var form3 = document.getElementById('city_form');
var user_slider_list = document.getElementById('user_slider_table');
var user_news_list= document.getElementById('user_news_table');
var user_marquee_list = document.getElementById('user_marquee_table');
var user_marquee_list = document.getElementById('user_form');



function dashboard(){
   
if(main_content.style.display=== "none"){
 slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="block";
 
}
else{
 main_content.style.display = "none";
}
}


function slider_list(){

if(slider_table.style.display=== "none"){
 slider_table.style.display = "block";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
 
}
else{
 slider_table.style.display = "none";
}
}

function news_list(){

if(news_table.style.display=== "none"){
   slider_table.style.display = "none";
 news_table.style.display = "block";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
 
 
}
else{
 news_list.style.display = "none";
}
}

function marquee_list(){
 
if(marquee_table.style.display=== "none"){
   slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "block";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
}
else{
 marquee_table.style.display = "none";
}
}

function marquee_list(){
  
if(marquee_table.style.display=== "none"){
   slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "block";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
}
else{
 marquee_table.style.display = "none";
}
}

function admin1(){

if(admin.style.display=== "none"){
 admin.style.display = "block";
 sub_admin.style.display = "none";
 slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 main_content.style.display="none";
}
else{
 admin.style.display = "none";
}
}

function subadmin(){

if(sub_admin.style.display=== "none"){
   main_content.style.display="none";
 sub_admin.style.display = "block";
 admin.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 slider.style.display = "none";
 main_content.style.display="none";
}
else{
 sub_admin.style.display = "none";
}
}

function user(){

if(user_form.style.display=== "none"){
 sub_admin.style.display = "none";
 admin.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 main_content.style.display="none";
 user_form.style.display = "block";
}
else{
 user_form.style.display = "none";
}
}

function slider() {



if (form1.style.display === 'none') {
   form1.style.display = 'block';
   form2.style.display = 'none';
   form3.style.display = 'none';
   slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";

} else {
   form1.style.display = 'none';
}
}

function news() {



console.log('news');

if (form2.style.display === 'none') {
   
   form2.style.display = 'block';
   form1.style.display = 'none';
   form3.style.display = 'none';
   slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
   
}
else{
    form2.style.display = "none";
}
}

function marquee() {



console.log('marquee');

if (form3.style.display === 'none') {
   form1.style.display = 'none';
   form2.style.display = 'none';
   form3.style.display = 'block';
   slider_table.style.display = "none";
 news_table.style.display = "none";
 marquee_table.style.display = "none";
 admin.style.display = "none";
 sub_admin.style.display = "none";
 main_content.style.display="none";
} else {
   form3.style.display = 'none';
}
}
function usersliderlist() {
   if (user_slider_list.style.display === "none" || user_slider_list.style.display === "") {
       slider_table.style.display = "none";
       news_table.style.display = "none";
       marquee_table.style.display = "none";
       admin.style.display = "none";
       sub_admin.style.display = "none";
       main_content.style.display = "none";
       user_slider_list.style.display = "block";
       user_news_list.style.display = "none";
       user_marquee_list.style.display = "none";
   } else {
       user_slider_list.style.display = "none";
   }
}

function usernewslist() {
   if (user_news_list.style.display === "none" || user_news_list.style.display === "") {
       slider_table.style.display = "none";
       news_table.style.display = "none";
       marquee_table.style.display = "none";
       admin.style.display = "none";
       sub_admin.style.display = "none";
       main_content.style.display = "none";
       user_slider_list.style.display = "none";
       user_news_list.style.display = "block";
       user_marquee_list.style.display = "none";
   } else {
       user_news_list.style.display = "none";
   }
}

function usermarqueelist() {
   if (user_marquee_list.style.display === "none" || user_marquee_list.style.display === "") {
       slider_table.style.display = "none";
       news_table.style.display = "none";
       marquee_table.style.display = "none";
       admin.style.display = "none";
       sub_admin.style.display = "none";
       main_content.style.display = "none";
       user_slider_list.style.display = "none";
       user_news_list.style.display = "none";
       user_marquee_list.style.display = "block";
   } else {
       user_marquee_list.style.display = "none";
   }
}
