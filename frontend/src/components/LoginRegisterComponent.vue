<template>
<div class="background">
        <div class="register-box">
            <div class="form-register-box register">
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
</template>
<script>
export default {
    name: "LoginRegister"
}
</script>
<style scoped>

.background {
    width: 100%;
    height: 100vh;
    background: #000;
}

.register-box .form-register-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    background: transparent;
    backdrop-filter: blur(20px);
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    color: #e4e4e4;
}

.form-register-box h2 {
    font-size: 32px;
    text-align: center;
}

.form-register-box .input-box {
    position: relative;
    width: 340px;
    height: 50px;
    border-bottom: 2px solid #e4e4e4;
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 16px;
    color: #e4e4e4;
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

.btn {
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