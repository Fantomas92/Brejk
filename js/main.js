// JavaScript Document

var id_team = 0;

$('#intro').on('submit', function(e) {
 id_team = parseInt( $('#intro input[name="id_team"]').val() );

 if( typeof(id_team) == 'number' && id_team > 0 ) {
  loadDataScreen(id_team);
 } else {
  $('#intro input[name="id_team"]').css('border-color', 'red').on('click', function() {
   $(this).css('border-color', '#eeeeee');
  });
 }

 e.preventDefault();
});

function loadDataScreen(id_team) {

 $('#intro').remove();

 $.ajax({
  url: 'loading-screen.php'
 }).success(function(data) {
  $('body').append(data);
  loadTeamInfo(id_team);
 });

}

function loadTeamInfo(id_team) {
 $.ajax({
  url: 'crawler/loadTeamInfo.php',
  data: { id_team: id_team }
 }).success(function(data) {
  $('#team-info').removeClass('yellow').addClass('green');
  $('#players-info').removeClass('red').addClass('yellow');
  loadPlayersInfo(id_team);
 });
}

function loadPlayersInfo(id_team) {
 $.ajax({
  url: 'crawler/loadPlayers.php',
  data: { id_team: id_team }
 }).success(function(data) {
  $('#players-info').removeClass('yellow').addClass('green');
  $('#leaque-matches').removeClass('red').addClass('yellow');
  loadMatches(id_team);
 });
}

function loadMatches(id_team) {
 $.ajax({
  url: 'crawler/loadLeagueMatches.php',
  data: { id_team: id_team }
 }).success(function(data) {
  $('#leaque-matches').removeClass('yellow').addClass('green');
  $('#stadium').removeClass('red').addClass('yellow');
  loadStadium(id_team);
 });
}

function loadStadium(id_team) {
 $.ajax({
  url: 'crawler/loadStadium.php',
  data: { id_team: id_team }
 }).success(function(data) {
  $('#stadium').removeClass('yellow').addClass('green');
  $('#sorting-data').removeClass('red').addClass('yellow');
  sortData(id_team);
 });
}

function sortData(id_team) {

 $('#sorting-data').removeClass('yellow').addClass('green');

 window.location = 'screen.php?id_team='+ id_team;
 
}