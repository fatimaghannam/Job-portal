    const wrap = document.getElementById('wrap');
    const toSignUp = document.getElementById('toSignUp');
    const overlayContent = document.getElementById('overlayContent');

    // When the overlay is on the right (default), we show Sign In.
    // Clicking the button slides the overlay left and reveals Sign Up.
    
    function switchMode(signup) {
      // toggle the "signup" class on the main wrapper (CSS uses this to move panels)
      wrap.classList.toggle('signup', signup);

      /*This block is controlling what text + button appear on the purple sliding panel */
      
      if (signup) {
        // if we're in Sign Up mode:
    // show text for "Welcome Back" and a SIGN IN button in the overlay
       
          overlayContent.innerHTML = ` 
          <h2>Welcome Back!</h2>
          <p>Enter your details to sign in and continue.</p>
          <button class="linkbtn" id="toSignIn">SIGN IN</button>
        `;
        // when the new SIGN IN button is clicked, switch back to Sign In mode
       
        document.getElementById('toSignIn').onclick = () => switchMode(false); /*When the SIGN IN button is clicked → go back to Sign In Mode*/
      
      } else {
        // if we're in Sign In mode:
    // show text for "Hello, Friend" and a SIGN UP button in the overlay
        overlayContent.innerHTML = `
          <h2>Hello, Friend!</h2>
          <p>Register with your details to use all of the site features.</p>
          <button class="linkbtn" id="toSignUp">SIGN UP</button>`;
        
        // when the new SIGN UP button is clicked, switch to Sign Up mode
          document.getElementById('toSignUp').onclick = () => switchMode(true);
      }
    }

    toSignUp.addEventListener('click', () => switchMode(true)); /*It tells the website to switch to the Sign Up view when the Sign Up button is clicked*/

    // This code prevents the page from reloading 
    // when the form is submitted and shows a simple message instead.
    
    const signInForm = document.getElementById('signInForm');

    //e is for event object, contains info about the click
    if (signInForm) {
    document.getElementById('signInForm').addEventListener('submit', e => {
      e.preventDefault();// stop page reload (handle it with JS instead)
       
      const email = signInForm.email.value.trim();
      const password = signInForm.password.value.trim();
      
      //for part 2 : add jobs
      // if email is not empty and password length is at least 10 characters
    // then go to jobs page
      
      if(email && password.length >=10){
        //goes to jobs.php
        window.location.href="http://localhost/FINAL/jobs.php";
      }else{
        alert('Please enter a valid email or password(min 10 charecters).');
      }
    });
  }

  // when the Sign Up form is submitted

    document.getElementById('signUpForm').addEventListener('submit', e => {
      e.preventDefault();
      alert('Account created.');
    });
