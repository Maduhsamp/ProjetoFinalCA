<template>
    <div class="background">
        <div class="blob"></div>
        <div class="container">

            <div class="logreg-box">
                <div class="content">
                    <div class="animation-container">
                        <div class="animation" id="animation1"></div>
                        <div class="animation" id="animation2"></div>
                    </div>
                    <div class="text-sci">
                        <h2>Esqueceu a Senha?</h2>
                    </div>
                </div>
                <div class="form-box login">
                    <form @submit.prevent="submitForgotPass">
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-envelope'></i></span>
                            <input type="email" v-model="formData.email" required>
                            <label> Email </label>

                        </div>
                        <button type="submit" class="btnSend">Enviar Email </button>
                        <div class="social-icons">
                            <a href="https://www.instagram.com/3cplusnow/" target="_blank"><i
                                    class='bx bxl-instagram'></i></a>
                            <a href="https://www.tiktok.com/@3cplusnow?_t=8mLHaRJrc3C&_r=1" target="_blank"><i
                                    class='bx bxl-tiktok'></i></a>
                            <a href="https://3cplusnow.com/pt/" target="_blank"><i class='bx bx-receipt'></i></a>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>

</template>

<script>
import HttpService from '@/services/HttpService';
import { useToast } from 'vue-toastification';
export default {
    name: 'ForgotPassword',

    data() {
        return {
            formData: {
                email: '',
            },
        }
    },
    methods: {
        async submitForgotPass() {
            const toast = useToast();
            try {
                const response = await HttpService.post('forgot-password', {
                    email: this.formData.email,
                });
                toast.success('Email de recuperação enviado com sucesso!');
            } catch (error) {
                toast.error('Falha ao enviar email de recuperação!');
            }
        },
    },
    mounted() {
        let currentAnimation = 0;
        const animations = document.querySelectorAll('.animation');

        function showNextAnimation() {
            animations[currentAnimation].classList.remove('active');

            currentAnimation = (currentAnimation + 1) % animations.length;
            setTimeout(() => {
                animations[currentAnimation].classList.add('active');
            }, 500)
        }

        animations[currentAnimation].classList.add('active');

        setInterval(showNextAnimation, 5000);
    }
}
</script>
<style scoped>
@media screen and (max-width: 1920px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 15s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(1350px, 350px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}

@media screen and (max-width: 1450px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 20s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(800px, 220px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}

@media screen and (max-width: 1368px) {
    .blob {
        position: absolute;
        width: 500px;
        height: 500px;
        background: linear-gradient(90deg, #3057F2, #9ADCFF);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
        transition: 1s cubic-bezier(0.075, 0.82, 0.165, 1);
        transform: translate(-200px, -50px) rotate(-90deg);
        animation: animateBlob 20s infinite alternate;
    }

    .blob:hover {
        width: 520px;
        height: 520px;
        filter: blur(30px);
        box-shadow:
            inset 0 0 0 5px rgba(255, 255, 255, .6),
            inset 100px 100px 0 0 #e9fe00,
            inset 200px 200px 0 0 #ff03ea,
            inset 300px 300px 0 0 #2b86c5;
    }

    @keyframes animateBlob {

        100% {
            transform: translate(800px, 80px) rotate(-10deg);
            border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
        }

    }
}



body {
    overflow: hidden;
}


.animation-container {
    margin-top: 50px;
    position: relative;
    width: 430px;
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

.animation.active {
    opacity: 1;
    transform: translateY(100%);
    animation-name: slide-in;
    animation-duration: 0.5s;
    animation-timing-function: ease-in-out;
}

@keyframes slide-in {
    0% {
        opacity: 0;
    }

    45% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }

}


#animation1 {
    background-color: transparent;
    background-image: url(https://media.glassdoor.com/sqll/2841457/3c-plus-squareLogo-1662652407726.png);
    width: 200px;
    top: -110%;
}

#animation2 {
    background-color: transparent;
    background-image: url('../assets/img/IMG.png');
    background-size: cover;
    top: -110%;

}

.content h2[data-v-1a06ad70] {
    font-size: 32px;
    text-align: center;
}


.social-icons:first-of-type {
    margin: 15px;
    margin-left: 30px;
}

.social-icons a i {
    text-decoration: none;
    color: black;
    margin: 15px;
    font-size: 22px;
    transition: .5s ease;
}

.social-icons a:hover i {
    transform: scale(1.2);
}


.background {
    width: 100%;
    height: 100vh;
    background: url(../assets/img/fundo.png)
}


.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 520px;
    height: 600px;
    background: #e4e4e4;
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    padding-top: 30px;
    border-radius: 10px;
    opacity: 90%;
}




.content h2 {
    font-size: 40px;

}

.btnSend {

    width: 100%;
    height: 45px;
    background: linear-gradient(90deg, #3057F2, #9ADCFF);
    border: none;
    outline: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    box-shadow: 0 0 10px rgba(0, 0, 0, .5);
    transition: .5s;
}

.btnSend:hover {
    background: linear-gradient(90deg, #FF8AAE, #FFF89A);
    color: #000;
    transition: .5s;
}


.logreg-box .form-box {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 150px;
    background: transparent;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    color: black;
}

.logreg-box .form-box.login {
    transform: translateX(0);
    transition: transform .6s ease;
    transition-delay: .7s;
}

.logreg-box.active .form-box.login {
    transform: translateX(430px);
    transition-delay: 0s;
}

.logreg-box .form-box.register {
    transform: translateX(430px);
    transition: transform .6s ease;
    transition-delay: 0s;
}

.social-icons {
    margin-top: 20px
}

.form-box {
    margin-top: 30px;
}

.form-box h2 {

    font-size: 32px;
    text-align: center;
    margin-bottom: 40px;
}

.form-box .input-box {
    position: relative;
    width: 340px;
    height: 50px;
    border-bottom: 2px solid #3057F2;
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 500;
    padding-right: 28px;
}

.input-box label {
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
.input-box input:valid~label {
    top: -5px;
}

.input-box .icon {
    position: absolute;
    top: 13px;
    right: 0;
    font-size: 19px;
}

.form-box .remember-forgot {
    font-size: 14.5px;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
}
</style>