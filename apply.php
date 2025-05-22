<?php
  $pageTitle = "IT Job Application";
  include "header.inc";
?>
  <!-- Navigation within page-->
  <aside class="side-shortcuts">
      <p>
          <a href="#">Back to top</a>
      </p>
      <p>
          <a href="#personalData">Personal Data</a>
      </p>
      <p>
          <a href="#Address">Address</a>
      </p>
      <p>
        <a href="#Contact">Contact</a>
      </p>
      <p>
        <a href="Skills">Skills</a>
      </p>
  </aside>
<main>
  <fieldset>
     <hr>

     <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
        <h2>Register Your Interest</h2>
      
        <label for="job-ref">Job Reference Number:</label>
        <select id="job-ref" name="job-ref" required>
          <option value="">-- Select Job Reference --</option>
          <option value="JD101">JD101 - Junior Software Developer</option>
          <option value="CS205">CS205 - Cybersecurity Specialist</option>
        </select>
        <br><br>
        
        <section id="personalData">
          <fieldset>
            <header><h3>Personal Data</h3></header>
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" maxlength="20" pattern="[A-Za-z]{1,20}" required>
            <br><br>
        
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" maxlength="20" pattern="[A-Za-z]{1,20}" required>
            <br><br>
        
            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" pattern="\d{2}/\d{2}/\d{4}" placeholder="dd/mm/yyyy" required>
            <br><br>
        
            <fieldset>
            <legend>Gender</legend>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="Other">
            <label for="other">Other</label>
            </fieldset>
            <br>
          </fieldset>
        </section>

        <section id="Address">
          <fieldset>
            <header><h3>Address Information</h3></header>
            <label for="address">Street Address:</label>
            <input type="text" id="address" name="address" maxlength="40" required>
            <br><br>
        
            <label for="suburb">Suburb/Town:</label>
            <input type="text" id="suburb" name="suburb" maxlength="40" required>
            <br><br>
        
            <label for="state">State:</label>
            <select id="state" name="state" required>
            <option value="">-- Select State --</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
            </select>
            <br><br>
        
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode"  min="200" max="9944"  required>
            <br><br>
          </fieldset>
        </section>
        
        <section id="Contact">
          <fieldset>
            <header><h3>Contact Information</h3></header>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
            <br><br>
        
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9 ]{8,12}" required>
            <br><br>
          </fieldset>
        </section>
      
        <section id="Skills">
            <header><h3>Skills Information</h3></header>
            <fieldset>
            <legend>Required Technical Skills</legend>
            <input type="checkbox" id="html" name="skills" value="HTML">
            <label for="html">HTML</label>
            <input type="checkbox" id="css" name="skills" value="CSS">
            <label for="css">CSS</label>
            <input type="checkbox" id="javascript" name="skills" value="JavaScript">
            <label for="javascript">JavaScript</label>
            <input type="checkbox" id="python" name="skills" value="Python">
            <label for="python">Python</label>
            <input type="checkbox" id="java" name="skills" value="Java">
            <label for="java">Java</label>
            
            <br>
        
            <label for="other-skills">Other Skills:</label><br>
            <textarea id="other-skills" name="other-skills" rows="4" cols="40" placeholder="List other skills here..."></textarea>
            <br><br>
          </fieldset>
        </section>
      
        <input type="submit" value="Apply">
      </form>
  </fieldset>
  </main>
<?php include "footer.inc"; ?>