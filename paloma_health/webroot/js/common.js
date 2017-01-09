$('#ssn').keyup(function() {
    var val = this.value.replace(/\D/g, '');
    var newVal = '';
    var sizes = [3, 2, 4];

    for (var i in sizes) {
      if (val.length > sizes[i]) {
        newVal += val.substr(0, sizes[i]) + '-';
        val = val.substr(sizes[i]);
      }
      else
        break;        
    }

    newVal += val;
    this.value = newVal;
});
$('#ssn').keyup();
$('#home-phone, #rp-home-phone, #rp-cell, #cell, #ppp-phone, #pp-phone').keyup(function(ev) {
  var key = ev.which;
  if (key < 48 || key > 57 || key != 45) {
    ev.preventDefault();
  }

  if (this.value.length > 12) {
    this.value = this.value.slice(0, -1);
    return;
  }

  this.value = this.value.replace(/^(\d{3})(\d)/, '$1-$2')
    .replace(/^(\d{3}-\d{3})(\d)/, '$1-$2');
});
$('#home-phone, #rp-home-phone, #rp-cell, #cell, #ppp-phone, #pp-phone').keyup();
$(".patient.form .btn-primary").click(function(){
//$(".patient.form .required .input").focus();
$(".patient.form .required input").css("border","1px solid");
$(".patient.form .required input").css("border-color","#e9322d");
$(".patient.form .required input").css("box-shadow","0 0 6px #f8b9b7");

})