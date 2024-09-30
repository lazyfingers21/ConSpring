
class Sole{
    get(url) {
        var request = fetch(url)
        return request.then(response => response.json())
    }
    post(url,value){
        var request = fetch(url,{
            method: 'POST',
            body: new URLSearchParams(value)
        })
        return request.then(response => response.json())
    }
    put(url,value){
        var request = fetch(url,{
            method: 'POST',
            body: new URLSearchParams(value)
        })
        return request.then(response => response.json())
    }
    delete(url,value){
        var request = fetch(url,{
            method: 'POST',
            body: new URLSearchParams(value)
        })
        return request.then(response => response.json())
    }
    element(id){
        var response = document.getElementById(id)
        return response
    }
    info(value, position = null){
        if(position == null){
            position = "top-right";
        }
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "hideDuration": 20000,
            "positionClass": "toast-"+position,
        }
        toastr.info(value);
    }
    success(value, position = null){
        if(position == null){
            position = "top-right";
        }
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "hideDuration": 20000,
            "positionClass": "toast-"+position,
        }
        toastr.success(value);
    }
    warning(value, position = null){
        if(position == null){
            position = "top-right";
        }
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "hideDuration": 20000,
            "positionClass": "toast-"+position,
        }
        toastr.warning(value);
    }
    error(value, position = null){
        if(position == null){
            position = "top-right";
        }
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "hideDuration": 20000,
            "positionClass": "toast-"+position,
        }
        toastr.error(value);
    }
    printer(value){
        var body = document.body;
        var printContents = sole.element(value).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        var body = document.body;
    }
}
var sole = new Sole;

