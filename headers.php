<head>

	<title>MONEY</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="./favicon.png" type="image/x-icon">
  <link href="assets/datatable/style.css" rel="stylesheet">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="manifest" href="manifest.json">
</head>

<script>
        window.addEventListener('load', () => {
          registerSW();
        });
     
        // Register the Service Worker
        async function registerSW() {
          if ('serviceWorker' in navigator) {
            try {
              await navigator
                    .serviceWorker
                    .register('serviceworker.js');
            }
            catch (e) {
              console.log('SW registration failed');
            }
          }
        }
     </script>
      <script>
         $(document).ready(function () {
        $('#tables').DataTable({
            scrollX: true,
            info: false,
            paging:false,
            pageLength:50,
            "language": {
                searchPlaceholder: 'Chercher',
                search: '',
                zeroRecords : 'Rien à Afficher',
                
                paginate:{
                    previous:'Précédent',
                    next:'Suivant',
                }
            }
        });
    });
        </script>