<template>
    <div class="background">
        <div class="blob"></div>
        <div class="container">
            <pre>
        </pre>
            <div class="content">
                <div class="animation-container">
                    <div class="animation" id="animation1"></div>
                    <div class="animation" id="animation2"></div>
                </div>
                <div class="text-sci">
                    <h2> Sua jornada começa aqui </h2>

                    <p>Um único login para todos os produtos da 3C Plus</p>


                    <div class="social-icons">
                        <a href="https://www.instagram.com/3cplusnow/" target="_blank"><i
                                class='bx bxl-instagram'></i></a>
                        <a href="https://www.tiktok.com/@3cplusnow?_t=8mLHaRJrc3C&_r=1" target="_blank"><i
                                class='bx bxl-tiktok'></i></a>
                        <a href="https://3cplusnow.com/pt/" target="_blank"><i class='bx bx-receipt'></i></a>
                    </div>
                </div>
            </div>

            <div class="logreg-box" :class="{ 'active': isActive }">
                <div class="form-box login" v-if="!isActive">
                    <form @submit.prevent="submitLoginForm">
                        <h2> Entrar </h2>
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-envelope'></i></span>
                            <input type="email" v-model="formData.email" required>
                            <label> Email </label>
                        </div>
                        <div class="input-box">
                            <input v-if="!showPasswordLogin" type="password" v-model="formData.password" required>
                            <input v-if="showPasswordLogin" type="text" v-model="formData.password" required>
                            <label> Senha </label>
                            <span><button class="icon-eye-login" @click="toggleShowPasswordLogin">
                                    <img v-if="showPasswordLogin" src="../assets/eye-open.svg" alt="Olho aberto">
                                    <img v-else src="../assets/eye-closed.svg" alt="Olho fechado">
                                </button></span>
                        </div>
                        <div class="remember-forgot">
                            <router-link to="/forgotpassword"><a href="">Esqueceu a Senha?</a></router-link>
                        </div>

                        <button type="submit" class="btnSend">Entrar</button>

                        <div class="login-register">
                            <p> Não tem uma Conta? <a href="#" class="register-link" @click.prevent="showRegister">
                                    Registre-se</a></p>
                        </div>
                    </form>
                </div>

                <div class="form-box register" v-if="isActive">
                    <form @submit.prevent="submitRegisterForm">
                        <h2>Cadastre-se</h2>

                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-user'></i></span>
                            <input type="text" v-model="formData.name" required>
                            <label>Nome</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-envelope'></i></span>
                            <input type="email" v-model="formData.email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-box">
                            <input v-if="!showPasswordRegister1" type="password" v-model="formData.password" required>
                            <input v-if="showPasswordRegister1" type="text" v-model="formData.password" required>
                            <label>Senha</label>
                            <span><button class="icon-eye-register1" @click="toggleShowPasswordRegister1">
                                    <img v-if="showPasswordRegister1" src="../assets/eye-open.svg" alt="Olho aberto">
                                    <img v-else src="../assets/eye-closed.svg" alt="Olho fechado">
                                </button></span>
                        </div>
                        <div class="input-box">
                            <input v-if="!showPasswordRegister2" type="password"
                                v-model="formData.password_confirmation" required>
                            <input v-if="showPasswordRegister2" type="text" v-model="formData.password_confirmation"
                                required>
                            <label>Confirmar Senha</label>
                            <span><button class="icon-eye-register2" @click="toggleShowPasswordRegister2">
                                    <img v-if="showPasswordRegister2" src="../assets/eye-open.svg" alt="Olho aberto">
                                    <img v-else src="../assets/eye-closed.svg" alt="Olho fechado">
                                </button></span>
                        </div>

                        <button type="submit" class="btnSend">Cadastre-se</button>

                        <div class="login-register">
                            <p>Já tem uma conta? <a href="#" class="login-link" @click.prevent="showLogin">Entrar</a>
                            </p>
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
import { mapActions } from 'vuex';

export default {
    name: 'LoginRegisterComponent',

    data() {
        return {
            isActive: false,
            passwordLogin: '',
            passwordRegister1: '',
            passwordRegister2: '',
            showPasswordLogin: false,
            showPasswordRegister1: false,
            showPasswordRegister2: false,
            formData: {
                email: '',
                name: '',
                password: '',
                password_confirmation: ''
            },
        }
    },
    methods: {
        ...mapActions(['Login']),
        showLogin() {
            this.isActive = false;
        },
        showRegister() {
            this.isActive = true;
        },
        toggleShowPasswordLogin() {
            this.showPasswordLogin = !this.showPasswordLogin;
        },
        toggleShowPasswordRegister1() {
            this.showPasswordRegister1 = !this.showPasswordRegister1;
        },
        toggleShowPasswordRegister2() {
            this.showPasswordRegister2 = !this.showPasswordRegister2;
        },
        async submitLoginForm() {
            const toast = useToast();
            try {
                await this.Login({
                    email: this.formData.email,
                    password: this.formData.password
                });
                toast.success('Login realizado com sucesso!');
                this.$router.push('/dashboard');
            } catch (error) {
                toast.error('Falha ao realizar login. Verifique suas credenciais!');
                console.error('Login error:', error);
            }
        },
        async submitRegisterForm() {
            const toast = useToast();
            if (this.formData.password !== this.formData.password_confirmation) {
                toast.error('As senhas não coincidem!');
                return;
            }

            try {
                const response = await HttpService.post('register', {
                    name: this.formData.name,
                    email: this.formData.email,
                    password: this.formData.password,
                    password_confirmation: this.formData.password_confirmation
                });
                toast.success('Registro realizado com sucesso!');
                console.log('Registration successful:', response.data);
                this.isActive = false;
            } catch (error) {
                toast.error('Falha ao realizar registro. Tente novamente.');
                console.error('Registration error:', error);
            }
        }
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
            transform: translate(1350px, 300px) rotate(-10deg);
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
    background: url(../assets/img/fundo.png)
}


.container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60%;
    height: 550px;
    background: #e4e4e4;
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    border-radius: 10px;
    opacity: 90%;
}

.container .content {
    width: 58%;
    height: 100%;
    left: 0;
    top: 0;
    position: absolute;
    padding: 80px;
    opacity: 90%;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    padding-bottom: 100px;
}


.content h2 {
    font-size: 40px;

}

.social-icons:first-of-type {
    margin-left: 35px;
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

.text-sci h2 {
    font-size: 32px;
    text-align: center;
}

.text-sci p {
    font-size: 18px;
    margin: 20px 0;
    text-align: center;
}

.container .logreg-box {
    position: absolute;
    top: 0;
    right: 0;
    width: calc(100% - 58%);
    height: 100%;
    overflow: hidden;
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

.input-box {
    display: flex;
}

.input-box .icon-eye-login {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box .icon-eye-register1 {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box .icon-eye-register2 {
    background: none;
    border: none;
    cursor: pointer;
    margin-top: 40%;
    margin-left: 15%;
}

.input-box img {
    width: 24px;
    height: 24px;
}

.logreg-box .form-box {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
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

.logreg-box.active .form-box.register {
    transform: translateX(0);
    transition-delay: .7s;
}

.form-box h2 {
    font-size: 32px;
    text-align: center;
}

.text-sci p {
    font-size: 18px;
    margin: 20px 0;
    text-align: center;
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

.remember-forgot label input {
    accent-color: #e4e4e4;
    margin-right: 3px;
}

.remember-forgot a {
    color: #000;
    font-weight: 600;
    text-decoration: none;
}

.remember-forgot a:hover {
    text-decoration: underline;
}

.form-box .login-register {
    font-size: 14.5px;
    font-weight: 500;
    text-align: center;
    margin-top: 25px;
}

.login-register p a {
    color: #000;
    font-weight: 600;
    text-decoration: none;
}

.login-register p a:hover {
    text-decoration: underline;
}
</style>