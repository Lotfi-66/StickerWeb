{{--
  Template Name: 360 viewer
--}}

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">

  <title>360 Viewer</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }
    #container {
      width: 100%;
      height: 100%;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/panolens@0.12.0/build/panolens.min.js"></script>
</head>
<body>
<div id="container"></div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const imageUrl = params.get('image');
    console.log(imageUrl)

    const container = document.getElementById('container');
    const panorama = new PANOLENS.ImagePanorama(imageUrl);
    const viewer = new PANOLENS.Viewer({ container: container });
    viewer.add(panorama);
  });
</script>
</body>
</html>
