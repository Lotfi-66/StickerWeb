import * as THREE from 'three';
import { animate as animateFromModule } from './animate.js';

// Fonction pour charger les shaders
async function loadShader(url) {
    const response = await fetch(url);
    return await response.text();
}

let scene, camera, renderer, logo, raycaster, underlogoShape;
let isLogoVisible = false;
let isAnimating = false;
let animationProgress = 0;
let isUnderlogoVisible = true;

export async function init() {
    const themeUrl = window.themeUrl || '';

    // Création du conteneur Three.js
    const container = document.createElement('div');
    container.id = 'threejs-container';
    document.body.appendChild(container);

    // Ajout du champ de saisie de code
    addCodeInput();

    // Chargement des shaders
    const vertexShaderSource = await loadShader(`${themeUrl}/threejs-project/src/shaders/vertexShader.glsl`);
    const fragmentShaderSource = await loadShader(`${themeUrl}/threejs-project/src/shaders/fragmentShader.glsl`);
    const underlogoVertexShaderSource = await loadShader(`${themeUrl}/threejs-project/src/shaders/underlogoVertexShader.glsl`);
    const underlogoFragmentShaderSource = await loadShader(`${themeUrl}/threejs-project/src/shaders/underlogoFragmentShader.glsl`);

    // Création de la scène
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x111111);

    // Configuration de la caméra
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    // Configuration du renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    container.appendChild(renderer.domElement);

    // Création du raycaster pour la détection de la souris
    raycaster = new THREE.Raycaster();

    // Chargement des textures
    const textureLoader = new THREE.TextureLoader();
    const logoTexture = await textureLoader.loadAsync(`${themeUrl}/threejs-project/public/BENOW.png`);
    const holoTexture = await textureLoader.loadAsync(`${themeUrl}/threejs-project/public/Holo.jpg`);

    const material = new THREE.ShaderMaterial({
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
    const geometry = new THREE.PlaneGeometry(2, 2, 32, 32);
    logo = new THREE.Mesh(geometry, material);
    logo.visible = false; // Le logo est initialement caché
    logo.isMouseOver = false;
    logo.targetRotationX = 0;
    logo.targetRotationY = 0;
    scene.add(logo);

    // Création de la forme sous le logo
    const underlogoGeometry = new THREE.PlaneGeometry(2.2, 2.2, 32, 32);
    const underlogoMaterial = new THREE.ShaderMaterial({
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

    // Ajout des écouteurs d'événements
    renderer.domElement.addEventListener('mousemove', onMouseMove);
    window.addEventListener('resize', onWindowResize);

    // Démarrer l'animation
    animate();
}

function addCodeInput() {
    const inputContainer = document.createElement('div');
    inputContainer.style.position = 'absolute';
    inputContainer.style.bottom = '20px';
    inputContainer.style.left = '50%';
    inputContainer.style.transform = 'translateX(-50%)';
    inputContainer.style.display = 'flex';
    inputContainer.style.alignItems = 'center';
    inputContainer.style.zIndex = '1000';

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Entrez le code';
    input.style.padding = '10px';
    input.style.fontSize = '16px';
    input.style.marginRight = '10px';

    const submitButton = document.createElement('button');
    submitButton.textContent = 'Activer';
    submitButton.style.padding = '10px 20px';
    submitButton.style.fontSize = '16px';
    submitButton.style.cursor = 'pointer';

    submitButton.addEventListener('click', () => {
        const code = input.value.trim();
        if (code) {
            toggleLogo(code);
        }
    });

    inputContainer.appendChild(input);
    inputContainer.appendChild(submitButton);
    document.body.appendChild(inputContainer);
}

function toggleLogo(code) {
    isLogoVisible = !isLogoVisible;
    logo.visible = isLogoVisible;
    
    if (isLogoVisible) {
        isAnimating = true;
        animationProgress = 0;
        isUnderlogoVisible = true;
        underlogoShape.visible = true;
        console.log(`Code activé : ${code}`);
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

    const rect = renderer.domElement.getBoundingClientRect();
    const mouseX = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    const mouseY = -((event.clientY - rect.top) / rect.height) * 2 + 1;

    raycaster.setFromCamera(new THREE.Vector2(mouseX, mouseY), camera);
    const intersects = raycaster.intersectObject(logo);
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
        logo.material.uniforms.rotationX.value = logo.rotation.x;
        logo.material.uniforms.rotationY.value = logo.rotation.y;

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
    animateFromModule(logo, renderer, scene, camera);
}