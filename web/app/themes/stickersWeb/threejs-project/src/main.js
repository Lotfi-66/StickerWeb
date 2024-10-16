// main.js
var THREE = window.THREE; // Assurez-vous que THREE.js est chargé avant ce script

var logoFiles = [
    '/BENOW.png',
    '/BENOWBURGER.png',
    '/BENOWICE.png',
    '/BENOWPARROT.png',
    '/BENOWPUMPKIN.png',
    '/BENOWSUSHI.png'
];

function loadTexture(path, onLoad) {
    var textureLoader = new THREE.TextureLoader();
    textureLoader.load(path, onLoad, undefined, function(error) {
        console.error("Erreur lors du chargement de la texture:", error);
    });
}

function createLogo(logoPath, callback) {
    var scene, camera, renderer, logo, underlogoShape;

    var logoItem = document.createElement('div');
    logoItem.className = 'logo-item';
    document.getElementById('app').appendChild(logoItem);

    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;

        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(1000, 1000);
        logoItem.appendChild(renderer.domElement);

        loadTexture(logoPath, function(logoTexture) {
            loadTexture('/Holo.jpg', function(holoTexture) {
                var material = new THREE.ShaderMaterial({
                    vertexShader: vertexShaderSource, // Assurez-vous que ces sources sont définies
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
                        underlogoColor: { value: new THREE.Color(0x000000) }
                    },
                    transparent: true,
                    side: THREE.DoubleSide
                });

                var geometry = new THREE.PlaneGeometry(2, 2, 32, 32);
                logo = new THREE.Mesh(geometry, material);
                logo.visible = true;
                scene.add(logo);

                var underlogoGeometry = new THREE.PlaneGeometry(2.1, 2.1, 32, 32);
                var underlogoMaterial = new THREE.ShaderMaterial({
                    uniforms: {
                        color: { value: new THREE.Color(0x000000) },
                        borderColor: { value: new THREE.Color(0xffffff) },
                        borderThickness: { value: 0.05 },
                        depth: { value: 0.3 }
                    },
                    vertexShader: underlogoVertexShaderSource, // Assurez-vous que ces sources sont définies
                    fragmentShader: underlogoFragmentShaderSource,
                    transparent: true
                });
                underlogoShape = new THREE.Mesh(underlogoGeometry, underlogoMaterial);
                underlogoShape.position.z = -0.01;
                scene.add(underlogoShape);

                callback({ logo: logo, underlogoShape: underlogoShape, renderer: renderer, scene: scene, camera: camera });
            });
        });
    }

    init();
}

function initAllLogos() {
    var logos = [];
    var underlogos = [];
    var renderers = [];
    var scenes = [];
    var cameras = [];

    var promises = logoFiles.map(function(logoPath) {
        return new Promise(function(resolve) {
            createLogo(logoPath, function(logoElements) {
                logos.push(logoElements.logo);
                underlogos.push(logoElements.underlogoShape);
                renderers.push(logoElements.renderer);
                scenes.push(logoElements.scene);
                cameras.push(logoElements.camera);
                resolve();
            });
        });
    });

    Promise.all(promises).then(function() {
        animate(logos, renderers, scenes, cameras, underlogos);
    });
}

// Initialiser tous les logos
initAllLogos();
