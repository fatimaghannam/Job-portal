// Open/close modal and show correct form

const applyBtn = document.getElementById('openApplyChoice');
const modal = document.getElementById('applyChoiceModal');
const chooseStudent = document.getElementById('chooseStudent');
const choosePro = document.getElementById('choosePro');
const studentForm = document.getElementById('studentForm');
const proForm = document.getElementById('proForm');
const formsWrapper = document.getElementById('applyForms');

// open the modal (set display to flex)
//for apply button in order to work
function showModal() {
  if (modal) {
    modal.style.display = 'flex';
  }
}

// hide the modal 
function hideModal() {
  if (modal) {
    modal.style.display = 'none';
  }
}
// when user clicks "Apply", show the modal
if (applyBtn) {
  applyBtn.addEventListener('click', showModal);
}

// Close when clicking outside modal content
if (modal) {
  modal.addEventListener('click', function (e) {
    if (e.target === modal) {  // only if clicking outside the inner box
      hideModal();
    }
  });
}

// when user chooses STUDENT option
if (chooseStudent) {
  chooseStudent.addEventListener('click', function () {
    hideModal();  // close modal
    if (proForm) proForm.style.display = 'none';  // hide professional form
    if (studentForm) studentForm.style.display = 'block'; // show student form
    if (formsWrapper) {
      formsWrapper.scrollIntoView({ behavior: 'smooth' }); //scroll to form
    }
  });
}

//when user chooses PROFESSIONAL option
if (choosePro) {
  choosePro.addEventListener('click', function () {
    hideModal();
    if (studentForm) studentForm.style.display = 'none'; // hide student form
    if (proForm) proForm.style.display = 'block';   // show professional form
    if (formsWrapper) {
      formsWrapper.scrollIntoView({ behavior: 'smooth' });
    }
  });
}

// Submit handlers: show success alert
if (studentForm) {
  studentForm.addEventListener('submit', function (e) {
    e.preventDefault(); // remove this when you connect to backend
    alert('Application completed successfully!');
    studentForm.reset();
  });
}

if (proForm) {
  proForm.addEventListener('submit', function (e) {
    e.preventDefault(); // remove when backend is ready
    alert('Application completed successfully!');
    proForm.reset();
  });
}
