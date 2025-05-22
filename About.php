<?php 
  $pageTitle = "Group Information";
  include "header.inc";
?>
  <!-- Navigation within page-->
  <aside class="side-shortcuts">
      <p>
          <a href="#">Back to top</a>
      </p>
      <p>
          <a href="#Class">Our Class</a>
      </p>
      <p>
          <a href="#Tutor">Our Tutor</a>
      </p>
      <p>
        <a href="#Contribution">Contribution</a>
      </p>
      <p>
        <a href="#GroupInterests">Group Interests</a>
      </p>
  </aside>
<main>
  <!-- Nested List -->
  <section id="Class">
    <h2>Group Details</h2>
    <ul>
      <li>Group Name: Code Crafters Collective
        <ul>
          <li>Class Time: 10:30-12:30</li>
          <li>Class Day: Thursday </li>
        </ul>
      </li>
    </ul>
  </section>

  <!-- Student IDs -->
  <section id="StudentId">
    <h2>Student IDs</h2>
    <ul>
      <li>Ethan Weinman: 105926046</li>
      <li>Ari Eddy: 105890976</li>
      <li>Charlie Cafici: 105927939</li>
      <li>Dylan Virduzzo: 105415515</li>
    </ul>
  </section>

  <!-- Tutor Name -->
  <section id="Tutor">
    <h2>Tutor</h2>
    <p>Our tutor is Razeen Hashmi</p>
  </section>

  <!-- Definition List for Contributions -->
  <section id="Contribution">
    <h2>Member Contributions</h2>
    <dl>
      <dt><strong>Ethan Weinman</strong></dt>
      <dd>Job Application page, group details page</dd>
      <dt><strong>Ari Eddy</strong></dt>
      <dd>Home page</dd>
      <dt><strong>Charlie Cafici</strong></dt>
      <dd>Job Description page, CSS styling</dd>
      <dt><strong>Dylan Virduzzo</strong></dt>
      <dd>CSS styling</dd>
    </dl>
  </section>

  <!-- Table with merged cells and caption -->
  <section id="GroupInterests">
    <h2>Members' Interests</h2>
    <table>
      <tr>
        <th>Name</th>
        <th>Hobbies</th>
        
      </tr>
      <tr>
        <td>Ethan W</td>
        <td>Drums</td>
      </tr>
      <tr>
        <td>Ari E</td>
        <td>Pokemon</td>
      </tr>
      <tr>
        <td>Charlie</td>
        <td>Gaming</td>
      </tr>
      <tr>
        <td>Dylan V</td>
        <td>Coding</td>
      </tr>
    </table>
  </section>
  </main>
</div>
<?php include "footer.inc"; ?>
