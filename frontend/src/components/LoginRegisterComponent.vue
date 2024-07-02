<template>
    <div class="container">
        <div class="content">
            <h2 class="logo"> 3C+ </h2>


            <div class="text-sci">
                <h2> Sua jornada começa aqui </h2>
    
                <p>Um único login para todos os produtos da 3C Plus</p>
    

                <div class="social-ico">
                    <a href="https://www.instagram.com/3cplusnow/"><i class='bx bxl-instagram'></i></a>
                </div>
            </div>
        </div>


        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <div class ="login-box">
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


        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginRegisterComponent',
}
</script>
<style scoped>

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
    }

    .content .logo{
        font-size: 56px;
        text-align: center;
    }

    .content h2{
        font-size: 40px;
    }

    .content p{
        font-size: 32px-;
    }

    .container .login-box{
        position: absolute;
        top: 0;
        right: 0;
        width: calc(100% - 58%);
        height: 100%;
        
    }

    .btn{
        background: #3057F2;
        color: white;
    }

    .login-box .form-box{
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

    .form-box h2{
        font-size: 32px;
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
        top: -5%;
    }

    .input-box .icon{
        position: absolute;
        top: 13px;
        right: 0;
        font-size: 20px;
    }

</style>