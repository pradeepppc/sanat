function viewPassworda(){
            console.log('cnajkcna');
            var pass = document.getElementById("passa");
            var eye =  document.getElementById("passstatus1");
            if(pass.type === "password")
            {
                pass.type = "text";
                eye.className='fa fa-eye-slash';
            }
            else
            {
                pass.type = "password";
                eye.className='fa fa-eye';
            }
        }

        function viewPasswordb(){
            var pass = document.getElementById("passb");
            var eye =  document.getElementById("passstatus2");
            if(pass.type === "password")
            {
                pass.type = "text";
                eye.className='fa fa-eye-slash';
            }
            else
            {
                pass.type = "password";
                eye.className='fa fa-eye';
            }
        }

 