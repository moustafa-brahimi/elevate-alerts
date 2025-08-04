
const pad = (num, size) => {
  num = num.toString();
  while (num.length < size) num = "0" + num;
  return num;
}


const notice = document.getElementById( "elevate-alerts-notice" )

if( notice ) {

    document.body.insertBefore( notice, document.body.firstChild )

    document.querySelectorAll(".btn-close-notice").forEach((item) => {
        const date = new Date();
  
        date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
  
        item.addEventListener("click", () => {
          notice.classList.add("elevate-alerts-notice--collapsed");
          notice.style.marginTop = `-${notice.offsetHeight}px`
          // document.cookie = `collapsed=true; ${date}; path=/;`;
        });
    });

    const countDowns = document.querySelectorAll(".elevate-alerts-countdown");

    if( countDowns.length ) {

      const {
        currentDate,
        targetedDate,      
      } = elevateAlertsCountdown;

      if( targetedDate != "none" ) {

        const clientServerDiffrence =  new Date(currentDate) - Date.now() // time diffrence between client and server

        const updateCountDown = () => {

          const 
            date1 = Date.now() + clientServerDiffrence,
            date2 = new Date(targetedDate),
            diffTime = ( date2 > date1 ? Math.abs(date2 - date1) : 0 );
  
          const 
            days = Math.trunc(diffTime / ( 24 * 60 * 60 * 1000 ) ),
            hours = Math.trunc( diffTime % ( 24 * 60 * 60 * 1000 ) / ( 60 * 60 * 1000 ) ),
            minutes = Math.trunc( diffTime % ( 60 * 60 * 1000 ) / ( 60 * 1000 ) ),
            seconds = Math.trunc( diffTime % ( 60 * 1000 ) / 1000 );

          console.log( date1+1,`${days}:${hours}:${minutes}:${seconds}` );
  
          countDowns.forEach(( countdown ) => {

            countdown.querySelector( ".elevate-alerts-countdown__days .value" ).textContent = days;
            countdown.querySelector( ".elevate-alerts-countdown__hours .value" ).textContent = pad( hours, 2 );
            countdown.querySelector( ".elevate-alerts-countdown__minutes .value" ).textContent = pad( minutes, 2 );
            countdown.querySelector( ".elevate-alerts-countdown__seconds .value" ).textContent = pad( seconds, 2 );

          });

        }

        window.setInterval( updateCountDown, 1000 )

       
      }

    }

}
