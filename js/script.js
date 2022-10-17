$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
    if(this.checked) {
    $('.checkBoxes').each(function(){
    this.checked = true;
    }); 
    } else {
    $('.checkBoxes').each(function(){
    this.checked = false;});}});


    const toggleSwitch = document.getElementById('customSwitch1');

    function switchTheme(event) {
      if (event.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');          }}

    toggleSwitch.addEventListener('change', switchTheme);
    
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme) {
      document.documentElement.setAttribute('data-theme', currentTheme);
      if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
          }}

        $('#editor').summernote({
            placeholder: '',
            tabsize: 2,
            height: 120,
            toolbar: [
              ['insert', ['link']]
            ]
          });

          $(document).on('click', '#rrr', function(){
            $('.countt').html('');
            $.ajax({ 
                      type: 'POST', 
                   data: {'rese': 1
                  }
                   });
          });

          $(document).on('click', '#vvv', function(){
            $('.count').html('');
            $.ajax({ 
                      type: 'POST', 
                   data: {'reset': 1
                  }
                   });
          });
          













          
/* ck */
/*           ClassicEditor
          .create( document.querySelector( '#editor' ), {
              toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
              heading: {
                  options: [
                      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                  ]
              }
          } )
          .catch( error => {
              console.log( error );
          } ); */


/* loading */
/*         var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);
$('#load-screen').delay(100).fadeOut(100, function(){
  $(this).remove();}  ) ; */


    });

    