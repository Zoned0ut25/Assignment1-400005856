<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="../../css/style.css" type="text/css">
     <script src="../../scripts/script.js" defer></script>
</head>
<body>
    <div class="h-full relative">
        <div class="h-[70px] fixed w-full lg:pl-56">
            <div class="w-full h-full bg-white p-4 border-b flex items-center shadow-sm">
                <button id="menuBtn" class="lg:hidden border border-slate-950 rounded">
                    <?php include("hamburger-icon.php"); ?>
                </button>
                <div class="ml-auto relative inline-block group">
                   <button class="rounded-full p-3 aspect-square bg-gray-200">
                       <?php include("user-icon.php"); ?>
                    </button>
                   <div class="hidden group-hover:block absolute  z-10 min-w-[300px] right-0 pt-2">
                    <div class="bg-white border shadow-sm rounded-md w-full flex flex-col overflow-hidden">
                        <span class=" py-2 px-4 hover:bg-slate-200"><?php if(isset($_SESSION["session_user"])) : echo($_SESSION['session_user']['role'].": ".$_SESSION['session_user']['username']); endif; ?></span>
                        <span class=" py-2 px-4 hover:bg-slate-200"><?php if(isset($_SESSION["session_user"])) : echo("Email: ".$_SESSION['session_user']['email']); endif; ?></span>                                
                        <a class="block py-2 px-4 hover:bg-slate-200 border-t" href="../logout.php">Logout</a>
                    </div>
                        
                   </div>
                </div>
            </div>
        </div>
        <div id="sidebar" class="w-56 fixed inset-y-0 transition-all transform -translate-x-full lg:translate-x-0 z-50">
            <div class="h-full border-r bg-white flex flex-col">
                <div class="w-full flex h-[70px] flex-col items-center justify-center">
                    <img src="../../img/logo.svg" alt="">
                </div>
                <div class="flex flex-col">
                    <a href="../index.php" class="pl-4 font-[500] flex items-center bg-slate-200">Studies
                        <div class="ml-auto border-2 py-7 border-teal-700 opacity-0"></div>
                    </a>
                    <?php if(isset($_SESSION["session_user"]) && $_SESSION["session_user"]["role"] === "Research Group Manager"){
                        echo('<a href="./" class="pl-4 font-[500] flex items-center bg-teal-200 text-teal-700">Researchers
                        <div class="ml-auto border-2 py-7 border-teal-700 opacity-100"></div>
                    </a>');
                    } ?>
                    
                </div>
            </div>
        </div>
        <main class="lg:pl-56 pt-[70px] h-full">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <div class="flex items-center py-2 px-4 ">
                        <h2 class="text-2xl font-[500]">Create New Researcher</h2>
                        
                        </div>
                        <?php

                        if(isset($success['success'])) : echo('<div class="bg-emerald-200 text-emerald-700 w-full px-4 py-2">'.$success['success'].'</div>'); endif;
                        ?>
                    </div>
                    
                    
                    <div class="p-6 flex justify-center items-center">

                        <form method="post" action="create.php" class="max-w-2xl w-full bg-white border rounded-md flex flex-col gap-y-2 p-4">
                            <h1 class="text-xl font-[500]">Create new user</h1>
                            <p class="text-sm text-slate-500 italic">Create a new user account.</p>
                            <div class="flex flex-col gap-y-2">
                                <label class="text-lg font-medium" for="username">Username</label>
                                <input 
                                type="text" 
                                name="username" 
                                class="border rounded p-2 text-sm"
                                value="<?php if(isset($_POST["username"])): echo $_POST["username"]; endif; ?>"
                                />
                                <span class="text-red-500"><?php if(isset($errors['username'])){ echo $errors['username'];} ?></span>
                            </div>
                            
                            <div class="flex flex-col gap-y-2">
                                <label class="text-lg font-medium" for="email">Email</label>
                                <input 
                                type="text" 
                                name="email" 
                                class="border rounded p-2 text-sm"
                                value="<?php if(isset($_POST["email"])): echo $_POST["email"]; endif; ?>"
                                />
                                <span class="text-red-500"><?php if(isset($errors['email'])){ echo $errors['email'];} ?></span>
                            </div>
                            
                            <div class="flex flex-col gap-y-2">
                                <label class="text-lg font-medium" for="password">Password</label>
                                <input 
                                type="password" 
                                name="password" 
                                class="border rounded p-2 text-sm"
                                value="<?php if(isset($_POST["password"])): echo $_POST["password"]; endif; ?>"
                                />
                                <span class="text-red-500"><?php if(isset($errors['password'])){ echo $errors['password'];} ?></span>
                            </div>
                            
                            <div class="flex flex-col gap-y-2">
                                <label class="text-lg font-medium" for="role">Role</label>
                                <select name="role" class="border rounded p-2 text-sm">
                                    <option value="Research Study Manager">Research Study Manager</option>
                                    <option value="Researcher">Researcher</option>
                                </select>
                            </div>
                            
                            <div class="flex gap-x-2">
                                <button name="create" class="text-sm bg-slate-950 rounded px-6 py-2 text-white font-[500]" type="submit">Create</button>
                                <a class="rounded px-6 py-2 border border-slate-950 text-slate-950" href="./">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="mx-auto py-2">
                        <h1 class="text-sm italic text-slate-500">Copyright &copy; Darron Brathwaite. All Rights Reserved.</h1>
                    </div>
                </div>
        </main>
    </div>
</body>
</html>
