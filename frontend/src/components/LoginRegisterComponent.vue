<template>
<div class="background">
    <div class="container">
        <div class="content">
            <div class="animation-container"> 
                <div class="animation" id="animation1"></div>
                <div class="animation" id="animation2"></div>
            </div>
            




            <div class="text-sci">
                <h2> Sua jornada começa aqui </h2>
    
                <p>Um único login para todos os produtos da 3C Plus</p>
    

                <div class="social-icons">
                    <a href="https://www.instagram.com/3cplusnow/" target="_blank"><i class='bx bxl-instagram'></i></a>
                    <a href="https://www.tiktok.com/@3cplusnow?_t=8mLHaRJrc3C&_r=1" target="_blank"><i class='bx bxl-tiktok'></i></a>
                    <a href="https://3cplusnow.com/pt/" target="_blank"><i class='bx bx-receipt'></i></a>
                </div>
            </div>
        </div>


        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <div class ="logreg-box">
            <div class="form-box login">
                <form action="#">
                    <h2> Entrar na Conta </h2>
                    <div class="input-box">
                        <span class="icon"><i class='bx bx-envelope'></i></span>
                        <input type="email" required>
                        <label> Email </label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                        <input type="password" required>
                        <label> Senha </label>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox">Lembrar Senha</label>
                        <a href="#"> Esqueceu a Senha?</a>
                    </div>

                    <button type="submit" class="btn"> Entrar </button>

                    <div class="login-register">
                        <p> Nao tem uma Conta? <a href="#" class="register-link"> Registre-se</a></p>
                    </div>
                    
                </form>
            </div>


            <div class="logreg-box">
                <div class="form-box register">
                    <form action="#">
                        <h2>Sign Up</h2>

                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-user'></i></span>
                            <input type="text" required>
                            <label>Name</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-envelope'></i></span>
                            <input type="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                            <input type="password" required>
                            <label>Password</label>
                        </div>
                        <div class="remember-forgot">
                            <label><input type="checkbox">I agree to the terms and conditions</label>
                        </div>
                        
                        <button type="submit" class="btn">Sign Up</button>

                        <div class="login-register">
                            <p>Already have an account? <a href="#" class="login-link">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
</template>

<script>
export default {
    name: 'LoginRegisterComponent',
    mounted(){
        let currentAnimation = 0;
        const animations = document.querySelectorAll('.animation');

        function showNextAnimation() {
            animations[currentAnimation].classList.remove('active');

            currentAnimation = (currentAnimation + 1) % animations.length;
            setTimeout(() => {
            animations[currentAnimation].classList.add('active'); // Mostra a próxima animação
            }, 500)
        }
        
        // Inicializa a primeira animação
        animations[currentAnimation].classList.add('active');

        // Altera a animação a cada 5 segundos
        setInterval(showNextAnimation, 5000);
        }
    }
</script>
<style scoped>

.animation-container {
    position: relative;
    width: 500px;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
}

.animation {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    transform: translateX(0);
    transition: transform 0.5s ease-in-out, opacity 0.27s ease-in-out;
}

.animation.active{
    opacity: 1;
    transform: translateY(100%);
    animation-name: slide-in;
    animation-duration: 0.5s;
    animation-timing-function: ease-in-out;
}

@keyframes slide-in{
    0% {opacity: 0;}
    45% {opacity: 0;}
    100% {opacity: 1;}

}


#animation1 {
    background-color: transparent;
    background-image: url(https://media.glassdoor.com/sqll/2841457/3c-plus-squareLogo-1662652407726.png);
    width: 200px;
    top: -115%;
}

#animation2 {
    background-color: transparent;
    background-image: url('../assets/img/IMG.png');
    background-size: cover;
    top: -135%;
    
}

.background {
    width: 100%;
    height: 100vh;
    background: white;
}

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 75%;
        height: 550px;
        background: #dedbdb;
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        border-radius: 10px;
    }

    .container .content {
        width: 58%;
        height: 100%;
        left: 0;
        top: 0;
        position: absolute;
        padding: 80px;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        padding-bottom: 100px;

    }


    .content h2{
        font-size: 40px;
    }

    .social-icons:first-of-type{
        margin: 15px;
    }

    .social-icons a i{
        text-decoration: none;
        color: black;
        margin: 15px;
        font-size: 22px;
        transition: .5s ease;
    }

    .social-icons a:hover i{
        transform: scale(1.2);
    }



    .container .logreg-box{
        position: absolute;
        top: 0;
        right: 0;
        width: calc(100% - 58%);
        height: 100%;
        
    }

    .btn{

        width: 100%;
        height: 45px;
        background: #c4103d;
        border: none;
        outline: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        color: #e4e4e4;
        font-weight: 500;
        box-shadow: 0 0 10px rgba(0, 0, 0, .5);
    }

    .logreg-box .form-box{
        display: flex;
        justify-content: center;
        align-items: center;
        background: transparent;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(20px);
        border-top-right-radius: 10px;
        border-left-right-radius: 10px;
        color: black;
    }

    .text-sci h2{
        font-size: 32px;
        text-align: center;
    }

    .text-sci p{
        font-size: 18px;
        margin: 20px 0;
        text-align: center;
    }

    .form-box .input-box{
        position: relative;
        width: 340px;
        height: 50px;
        border-bottom: 2px solid #3057F2;
        margin: 30px 0;
    }

    .input-box input{
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 16px;
        font-weight: 500;
        padding-right: 28px;
    }
    
    .input-box label{
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 16px;
        font-weight: 500;
        pointer-events: none;
        transition: .5s ease;
    }

    .input-box input:focus~label,
    .input-box input:valid~label{
        top: -5px;
    }

    .input-box .icon{
        position: absolute;
        top: 13px;
        right: 0;
        font-size: 19px;
    }

    .form-register-box .remember-forgot {
    font-size: 14.5px;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
}

.remember-forgot label input {
    accent-color: #e4e4e4;
    margin-right: 3px;
}


.form-register-box .login-register {
    font-size: 14.5px;
    font-weight: 500;
    text-align: center;
    margin-top: 25px;
}

.login-register p a {
    color: #e4e4e4;
    font-weight: 600;
    text-decoration: none;
}

.login-register p a:hover {
    text-decoration: underline;
}

</style>