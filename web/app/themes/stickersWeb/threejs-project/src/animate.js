// main.js
(function() {
    var scene, camera, renderer, logo, raycaster, underlogoShape;
    var isLogoVisible = false;
    var isAnimating = false;
    var animationProgress = 0;
    var isUnderlogoVisible = true;

    function loadShader(url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                callback(xhr.responseText);
            }
        };
        xhr.send();
    }

    function init() {
        var themeUrl = window.themeUrl || '';

        // Chargement des shaders
        loadShader(themeUrl + '/threejs-project/src/shaders/vertexShader.glsl', function(vertexShaderSource) {
            loadShader(themeUrl + '/threejs-project/src/shaders/fragmentShader.glsl', function(fragmentShaderSource) {
                loadShader(themeUrl + '/threejs-project/src/shaders/underlogoVertexShader.glsl', function(underlogoVertexShaderSource) {
                    loadShader(themeUrl + '/threejs-project/src/shaders/underlogoFragmentShader.glsl', function(underlogoFragmentShaderSource) {
                        initScene(vertexShaderSource, fragmentShaderSource, underlogoVertexShaderSource, underlogoFragmentShaderSource);
                    });
                });
            });
        });
    }

    function initScene(vertexShaderSource, fragmentShaderSource, underlogoVertexShaderSource, underlogoFragmentShaderSource) {
        // Création de la scène
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0x111111);

        // Configuration de la caméra
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;

        // Configuration du renderer
        renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('threejs-container').appendChild(renderer.domElement);

        // Création du raycaster pour la détection de la souris
        raycaster = new THREE.Raycaster();

        // Chargement des textures
        var textureLoader = new THREE.TextureLoader();
        textureLoader.load(window.themeUrl + '/threejs-project/public/BENOW.png', function(logoTexture) {
            textureLoader.load(window.themeUrl + '/threejs-project/public/Holo.jpg', function(holoTexture) {
                createMaterials(vertexShaderSource, fragmentShaderSource, underlogoVertexShaderSource, underlogoFragmentShaderSource, logoTexture, holoTexture);
            });
        });
    }

    function createMaterials(vertexShaderSource, fragmentShaderSource, underlogoVertexShaderSource, underlogoFragmentShaderSource, logoTexture, holoTexture) {
        var material = new THREE.ShaderMaterial({
            vertexShader: vertexShaderSource,
            fragmentShader: fragmentShaderSource,
            uniforms: {
                logoTexture: { value: logoTexture },
                holoTexture: { value: holoTexture },
                time: { value: 0 },
                rotationX: { value: 0 },
                rotationY: { value: 0 },
                mousePosition: { value: new THREE.Vector2(0, 0) },
                unrollProgress: { value: 0 },
                borderColor: { value: new THREE.Color(0xffffff) },
                borderThickness: { value: 0.01 },
                underlogoColor: { value: new THREE.Color(0xffffff) },
                backgroundColor: { value: new THREE.Color(0xffffff) }
            },
            transparent: true,
            side: THREE.DoubleSide
        });

        // Création de la géométrie et du mesh du logo
        var geometry = new THREE.PlaneGeometry(2, 2, 32, 32);
        logo = new THREE.Mesh(geometry, material);
        logo.visible = false; // Le logo est initialement caché
        logo.isMouseOver = false;
        logo.targetRotationX = 0;
        logo.targetRotationY = 0;
        scene.add(logo);

        // Création de la forme sous le logo
        var underlogoGeometry = new THREE.PlaneGeometry(2.2, 2.2, 32, 32);
        var underlogoMaterial = new THREE.ShaderMaterial({
            uniforms: {
                color: { value: new THREE.Color(0xffffff) },
                borderColor: { value: new THREE.Color(0xffffff) },
                borderThickness: { value: 0.05 },
                logoTexture: { value: logoTexture },
                depth: { value: 0.6 },
            },
            vertexShader: underlogoVertexShaderSource,
            fragmentShader: underlogoFragmentShaderSource,
            transparent: true
        });
        
        underlogoShape = new THREE.Mesh(underlogoGeometry, underlogoMaterial);
        underlogoShape.position.z = -0.01;
        scene.add(underlogoShape);

        // Ajout du bouton
        addButton();

        // Ajout des écouteurs d'événements
        renderer.domElement.addEventListener('mousemove', onMouseMove);
        window.addEventListener('resize', onWindowResize);

        // Démarrer l'animation
        animate();
    }

    function addButton() {
        var button = document.createElement('button');
        button.textContent = 'Activer le logo animé';
        button.style.position = 'absolute';
        button.style.bottom = '20px';
        button.style.left = '50%';
        button.style.transform = 'translateX(-50%)';
        button.style.padding = '10px 20px';
        button.style.fontSize = '16px';
        button.style.cursor = 'pointer';
        
        button.addEventListener('click', toggleLogo);
        
        document.getElementById('threejs-container').appendChild(button);
    }

    function toggleLogo() {
        isLogoVisible = !isLogoVisible;
        logo.visible = isLogoVisible;
        
        if (isLogoVisible) {
            isAnimating = true;
            animationProgress = 0;
            isUnderlogoVisible = true;
            underlogoShape.visible = true;
        } else {
            isAnimating = false;
            animationProgress = 0;
            logo.material.uniforms.unrollProgress.value = 0;
            isUnderlogoVisible = false;
            underlogoShape.visible = false;
        }
    }

    function onMouseMove(event) {
        event.preventDefault();

        var rect = renderer.domElement.getBoundingClientRect();
        var mouseX = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        var mouseY = -((event.clientY - rect.top) / rect.height) * 2 + 1;

        raycaster.setFromCamera(new THREE.Vector2(mouseX, mouseY), camera);
        var intersects = raycaster.intersectObject(logo);
        logo.isMouseOver = intersects.length > 0;

        if (logo.isMouseOver && isLogoVisible) {
            logo.targetRotationY = mouseX * 1.5;
            logo.targetRotationX = mouseY * 1.5;
            logo.material.uniforms.mousePosition.value.set(mouseX, mouseY);
        }
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    function animate() {
        requestAnimationFrame(animate);

        if (isLogoVisible) {
            logo.rotation.x += (logo.targetRotationX - logo.rotation.x) * 0.1;
            logo.rotation.y += (logo.targetRotationY - logo.rotation.y) * 0.1;
            
            logo.material.uniforms.time.value += 0.01;

            if (isAnimating) {
                animationProgress += 0.01;
                if (animationProgress >= 1) {
                    isAnimating = false;
                    animationProgress = 1;
                    
                    if (isUnderlogoVisible) {
                        isUnderlogoVisible = false;
                        underlogoShape.visible = false;
                    }
                }
                logo.material.uniforms.unrollProgress.value = animationProgress;
            }
        }

        renderer.render(scene, camera);
        window.animateThreeJS(logo, renderer, scene, camera);
    }

    // Initialisation de la scène et démarrage de l'animation
    document.addEventListener('DOMContentLoaded', init);
})();