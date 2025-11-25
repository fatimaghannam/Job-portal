// run code after the sigin
document.addEventListener('DOMContentLoaded', function () {
  const qInput   = document.getElementById('q');
  const citySel  = document.getElementById('city');
  const priceSel = document.getElementById('price');
  const applyBtn = document.getElementById('applyFilters');
  const clearBtn = document.getElementById('clearFilters');
  
  // get all job cards and put them into an array
  //This makes it easier to loop through all cards and apply filters or changes to each one.
  const cards = Array.from(document.querySelectorAll('.job-card'));


  //convert salary range into two numbers (ex: "2000-4000") into two numbers
  function parseRange(rangeStr) {
    if (!rangeStr) return [0, Number.MAX_SAFE_INTEGER]; //if empty allow all
    const parts = rangeStr.split('-'); // split into two 2000-4000
    const min = parseInt(parts[0], 10) || 0; //convert first part to number
    const max = parseInt(parts[1], 10) || Number.MAX_SAFE_INTEGER; // convert second part
    return [min, max];
  }


  // filter the card based on user input 
  function applyFilters() {
    const text = qInput.value.trim().toLowerCase(); //search text (title....)
    const city = citySel.value;//select city
    const [minSalary, maxSalary] = parseRange(priceSel.value); //select salary range

    
    
    // go through each jobs and check if it matches the filters 
    cards.forEach(card => {
      // read data stored in data-attributes in the HTML
      const title    = (card.dataset.title || '').toLowerCase();
      const company  = (card.dataset.company || '').toLowerCase();
      const category = (card.dataset.category || '').toLowerCase();
      const location = card.dataset.location || '';
      const salary   = parseInt(card.dataset.salary || '0', 10);

      // check text filter: if empty → accept all
      // else check if search text exists in title OR company OR category
      const matchesText =
        !text ||
        title.includes(text) ||
        company.includes(text) ||
        category.includes(text);

      const matchesCity =
        !city || location === city;

        // check if within salary range
      const matchesSalary =
        salary >= minSalary && salary <= maxSalary;

        /// Show or hide the card depending on whether it matches all filters
      if (matchesText && matchesCity && matchesSalary) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }


  // clear function of filters to reset and show all jobs again
  function clearFiltersFn() {
    qInput.value = '';
    citySel.value = '';
    priceSel.value = '';
    cards.forEach(card => {
      card.style.display = '';
    });
  }


  // filter and clear buttons 
  if (applyBtn) applyBtn.addEventListener('click', applyFilters);
  if (clearBtn) clearBtn.addEventListener('click', clearFiltersFn);
});



//  function to scroll a row of job cards left or right

function scrollRow(rowId, direction) {
  const row = document.getElementById(rowId); // get the row container by its id
  
  if (!row) return;// if row not found, stop
  
  const card = row.querySelector('.job-card'); // get one job card to know its width
  const step = card ? (card.offsetWidth + 16) : 280; // scroll by 1 card width + gap (16px)
  
   // scroll the row left or right smoothly
  row.scrollBy({ 
    left: step * direction, 
    behavior: 'smooth' }); 
    // fallback value if no card found
}
