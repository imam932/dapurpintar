<div class="pageapp-signup bg-5 cover-screen" style="width: 360px; height: 640px;">    
                <div class="pageapp-signup-content cover-center" style="margin-left: -150px; margin-top: -182px;">
                    <div class="boxed-layout">
                        <a class="pageapp-signup-logo" href="#"></a>
                        <form action="<?= base_url() ?>Register/New" method="post">
                        <div class="pageapp-signup-field">
                            <i class="fa fa-user"></i>
                            <input name="nama" onfocus="if (this.value=='Nama Lengkap') this.value = ''" onblur="if (this.value=='') this.value = 'Nama Lengkap'" type="text" value="Nama Lengkap">
                        </div>                    
                        <div class="pageapp-signup-field">
                            <i class="fa fa-envelope-o"></i>
                            <input name="email" onfocus="if (this.value=='E-Mail') this.value = ''" onblur="if (this.value=='') this.value = 'E-Mail'" type="email" value="E-Mail">
                        </div>                    
                        <div class="pageapp-signup-field">
                            <i class="fa fa-calendar-o"></i>
                            <input name="tgl_lahir" class="set-today" type="date">
                        </div>
                        <div class="pageapp-signup-field">
                            <i class="fa fa-lock"></i>
                            <input name="password" onfocus="if (this.value=='password') this.value = ''" onblur="if (this.value=='') this.value = 'password'" type="password" value="password">
                        </div>
                        <button type="submit" class="pageapp-signup-button button button-small button-green button-fullscreen">Register</button>
                        </form>
                    </div>
                </div>
                <div class="overlay bg-black" style="width: 360px; height: 640px;"></div>
                <a href="pageapp-signup2.html" class="left-button"><i class="fa fa-square"></i>Boxed Version</a>
                <a href="page-signup.html" class="right-button">Page Version <i class="fa fa-star"></i></a>
            </div>