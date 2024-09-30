/* Handles All Framework's JS */
function sortby(data){
    sole.post("AdminCustomerSort?show",{
        sortby: data
    })
    .then(res => displaycustomerlist(res))
}
function displaycustomerlist(data){
    var customerlist = sole.element('customerlist')
    if(customerlist){
        customerlist.innerHTML = ""
        data.forEach(ca => {
            customerlist.insertAdjacentHTML("afterbegin",
                '<tr>'+
                    '<td>'+ca["id"]+'</td>'+
                    '<td>'+ca["name"]+'</td>'+
                    '<td>'+ca["contactno"]+'</td>'+
                    '<td>'+ca["purokno"]+'</td>'+
                    '<td style="width: 230px;">'+
                        '<div class="row">'+
                            '<a href="AdminCustomerList?show&id='+ca["id"]+'" class="btn btn-sm btn-dark"><span class="fa fa-binoculars"></span> View</a>'+
                            '<a href="AdminCustomerList?handler&id='+ca["id"]+'" c class="btn btn-sm btn-dark"><span class="fa fa-pencil"></span> Edit</a>'+
                            '<a href="AdminCustomerList?destroy&type=solo&id='+ca["id"]+'" c class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</a>'+
                        '</div>'+
                    '</td>'+
                '</tr>'
            )
        })
    }
}
function searchcustomer(){
    var customersearch = sole.element("customersearch").value;
    sole.post("AdminCustomerSearch?show",{
        name: customersearch
    })
    .then(res => displaycustomerlist(res))
}
function sortbybr(data){
    sole.post("AdminBillingRecordSort?show",{
        sortby: data
    })
    .then(res => displaybillingrecordlist(res))
}
function displaybillingrecordlist(data){
    var billingrecordlist = sole.element('billingrecordlist')
    if(billingrecordlist){
        billingrecordlist.innerHTML = ""
        data.forEach(br => {
            billingrecordlist.insertAdjacentHTML("afterbegin",
                '<tr>'+
                    '<td>'+br["id"]+'</td>'+
                    '<td>'+br["start"]+'</td>'+
                    '<td>'+br["end"]+'</td>'+
                    '<td>'+br["collection"]+'</td>'+
                    '<td>'+br["due"]+'</td>'+
                    '<td>'+br["status"]+'</td>'+
                    '<td style="width: 230px;">'+
                        '<div class="row">'+
                            '<a href="AdminBillingRecord?show&id='+br["id"]+'" class="btn btn-sm btn-dark"><span class="fa fa-binoculars"></span> View</a>'+
                            '<a data-toggle="modal" data-target="#editbilling'+br["id"]+'" href="#" c class="btn btn-sm btn-dark"><span class="fa fa-pencil"></span> Edit</a>'+
                            '<a href="AdminBillingRecord?destroy&type=solo&id='+br["id"]+'" c class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</a>'+
                        '</div>'+
                    '</td>'+
                '</tr>'+
                '<div class="modal fade" id="editbilling'+br["id"]+'">'+
                    '<div class="modal-dialog">'+
                        ' <div class="modal-content">'+
                            '<div class="modal-header">'+
                                '<h6>Edit Billing Period</h6>'+
                            '</div>'+
                            '<form action="AdminBillingRecord?update&id='+br["id"]+'" method="post">'+
                                '<div class="modal-body">'+
                                    '<div class="form-group">'+
                                        '<div class="input-group">'+
                                            '<label class="btn btn-dark col-md-4">Start: </label>'+
                                            '<input required type="date" name="start" id="" class="form-control" value="'+br["start"]+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="input-group">'+
                                            '<label class="btn btn-dark col-md-4">End: </label>'+
                                            '<input required type="date" name="end" id="" class="form-control" value="'+br["end"]+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="input-group">'+
                                            '<label class="btn btn-dark col-md-4">Collection Date: </label>'+
                                            '<input required type="date" name="collection" id="" class="form-control" value="'+br["collection"]+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<div class="input-group">'+
                                            '<label class="btn btn-dark col-md-4">Due Date: </label>'+
                                            '<input required type="date" name="due" id="" class="form-control" value="'+br["due"]+'">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button class="btn btn-dark" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button>'+
                                    '<button class="btn btn-success"><span class="fa fa-save"></span> Save Changes</button>'+
                                '</div>'+
                            '</form>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            )
        })
    }
}
function searchbr(){
    var billingsearch = sole.element("billingsearch").value;
    sole.post("AdminBillingRecordSearch?show",{
        date: billingsearch
    })
    .then(res => displaybillingrecordlist(res))
}
function billingrecordview(data){
    sole.post("AdminBillingPeriod?show",{
        id: data
    })
    .then(res => displaybillingrecordview(res))
}
function displaybillingrecordview(data){
    sole.element('preading').innerHTML = "<b>Previous Reading:</b> "+data[0]['preading'];
    sole.element('creading').innerHTML = "<b>Current Reading:</b> "+data[0]['creading'];
    sole.element('used').innerHTML = "<b>Used:</b> "+data[0]['used'];
    sole.element('amount').innerHTML = "<b>Amount:</b> "+data[0]['amount'];
    sole.element('status').innerHTML = "<b>Status:</b> "+data[0]['status'];
    sole.element('datepaid').innerHTML = "<b>Date Paid:</b> "+data[0]['datepaid'];
}
function billingrecordedit(data){
    sole.post("AdminBillingPeriod?show",{
        id: data
    })
    .then(res => displaybillingrecordedit(res))
}
function displaybillingrecordedit(data){
    sole.element('preading').value = data[0]['preading'];
    sole.element('creading').value = data[0]['creading'];
    sole.element('used').value = data[0]['used'];
    sole.element('amount').value = data[0]['amount'];
    sole.element('status').value = data[0]['status'];
    sole.element('datepaid').value = data[0]['datepaid'];
}
function recipient(data){
    if(data == 'all'){
        sole.element('recipient').style = 'display: none'
    }else{
        sole.element('recipient').style = 'display: block'
    }
}
function menu(data){
    if(sole.element(data).style.display == "none"){
        sole.element(data).style = "display: block"
        if(data == "customermenu"){
            sole.element("billingmenu").style = "display: none"
        }else {
            sole.element("customermenu").style = "display: none"
        }
    }else if(sole.element(data).style.display == "block"){
        sole.element(data).style = "display: none"
    }
}
if(sole.element('datetime')){
    setInterval(startTime, 1000);    
}
function startTime() {
    var monthList = ["Null","January","Febuary","March","April","May","June","July","August","September","October","November","December"]
    var weekdaylist = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Null"]
    var today = new Date();
    today.toLocaleString('en-US', { hour: 'numeric', hour12: true });
    var weekday = today.getDay();
    var hours = today.getHours();
    var minutes = today.getMinutes();
    var seconds = today.getSeconds();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12;
    var month = today.getMonth() + 1;
    var day = today.getDate();
    var year = today.getFullYear();
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);
    document.getElementById('time').innerHTML = hours + ":" + minutes + ":" + seconds + " " + ampm;
    document.getElementById('date').innerHTML = weekdaylist[weekday] + ", " + monthList[month] + " " + day + " " + year;
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
function printslip(data){
    sole.printer(data);
}
