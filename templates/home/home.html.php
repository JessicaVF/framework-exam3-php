<p>Welcome to the documentation of this framework</p>

<div class="row">
<h2>Introduction</h2>
    <p>
        This is a PHP framework, created in 2021 in France, in the context
        of a professional formation in web development.
    </p>
    <p>
        The framework follow the <a href="https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller"> Model–view–controller (MVC) design pattern</a>.
        It can be use as base for any kind of project that follow the "blog
        format". 
    </p>
    <p>
        At it's most basic form the "blog format" is the one who display a list of items,
        then it allow a individual view of a selected item.
        We can play with this to create different kind of views,
        all of wich boild down to more or less the same.     
    </p>
    <p>
        A example of a "blog format" website (that is not a blog)
        is a food store. We will get a general view with all the products,
        and we can click in each of them to have a individual view.
        We can have also views based in the categories 
        (veggetables, meat, candy, etc).
    </p>
    
</div>

<div class="row">
<h2>Starting example</h2>
    <p>
        Change the message introducing your own message in
        the box
    </p>
</div>

<form method="POST">
    <input type="texarea" name="message" placeholder="votre message">
    <input type="submit" value="submit">
</form>
<p> Your message: <?php echo $message ?></p>


<h2>What it's happening?</h2>
<ul>
    <li> In the view side:
        <p>
            We are using a html form (method POST) to display and recolect the
            message.
        </p>
        <p>
            Each time you want to work with a view (what the final user will see) you must
            go to the folder "templates". In this case our view is a file called "home.html.php".
        </p>
        <p>
            Important : All the view files are to be end with ".html.php".Is a common mistake
            forget the ".html" or the ".php" in the name.
        </p>
        <p>
            The form method is "post". Meaning that the info recollected will be not avaible in
            the url (as it happens with the method get). This is in general more secure and it
            will be the most common method use in this framework.
        </p>
        <p>
            In our form the name given to the input is "message", this is important to recall
            so we can understand the next explanations.
        </p>
    </li>
    <li> At the controller side:
        <p> 
            All the controllers must be at the folder "controllers"
            (found inside the "core" folder).
        </p>
        <p>
            In this example the controller is the file called
            "Home".
        </p>
        <p>
            The controller Home have a method called "index" 
            (later we will see how we are calling it). This method
            in general prepare the data so we can ensemble our "index".
        </p>
        <p>
            This index method in particular evaluate if there's 
            information sent by our form, the information that we named
            "message".
        </p>
        <p>
            If there's not info we will have a pre-made message.
            If we have info, the "message" we will save it as "$message".
        </p>
        <p>
            At the end we call the render method of the Rendering class
            (to see later).
            This method will take the name of a template file and 
            the info we need for build the template content;
            in this case:the title and the message.
            
        </p>
    </li>
    <li> At the model side:
        <p>
            At this point the example is too basic to require
            use of a model. But, if for example, we would save in a
            database all the messages someone has type into the input box,
            we would have to use a model to manage the access and
            comunication with the database
        </p>


    </li>

</ul> 

<h2> Index as the only access point and the role of App </h2>
<p> App.php and index.php are vital, as they "start the magic". Let's start with App:</p>
<ul>
    <li>App.php:
        <p> App is inside of the folder Core. It's an class and also it's
        the place where we say to the website to wake up, to start existing.
        </p>
        <p> Inside App, we have the function process, that set two variables:
            <ul>
                <li>$controllerName:
                    <p>
                    The default is home, meaning the main page. This variable
                    is called "controller" for a reason. As we will use our website
                    we will need to use controllers to process the data and call their models.
                    Thanks to App we can do that in a dynamic way with the "$_GET".
                    </p>    
                </li>
                <li>$task
                    <p>
                     The default is index, meaning the function that "build" the main page. The 
                     task name actually refer to a function. We need that the function actually
                     exist into the controller we are calling. We set the task in a 
                     dinamic way thanks to  "$_GET".  
                    </p>
                </li>
                
            </ul>
        </p>
    </li>
    <li>index.php
    <p>App have the function to put everything in moving, but is index.php who call that function.
    It's all what that file does, but is essential</p>
    </li>
    <li>All together:
    <p>Now, App is going to get the name of the controller and the task we want from it.
        And then it will make the controller call the task.In a situation X where the task is
        to get X items and show them (meaning, change the view), we are going to see a change in the 
        url. We will get parametres, but we will be still in index.So, index.php is simple, but is 
        alwayz the page were we will be
    </p>
    </li>
</ul>

<p> NOTE: This here is the "object version" framerwork. The original framework
    work with associative arrays and this ones use objects. That changes
    alot behind the scene, but for now is enough to understand that:

    <ol> 
        <li> the class Database(.php) was change a bit </li>
        <li> when we recovery items from a database the notation to 
        call the propierties is "arrow notation". Example:
        "$item->name" 
        </li>
        <li> The classes need to have the atributes of the items they are
        representing. Is in the database the $item have a name, color and id
        we need those propierties as attributes in the class Item.
        </li>
    </ol>



<h6> Comming next </h6>    
For cover. The role of GET, POST?, inside of a controller-function. Rendering and http and when to use wich

