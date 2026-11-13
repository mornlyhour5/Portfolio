<section class="hero" id="top">
  <div class="wrap">
    <div>
      <p class="badge glass"><?= bi('Early in my journey, still learning', 'ចាប់ផ្តើមដំណើររបស់ខ្ញុំ នៅតែកំពុងរៀនសូត្រ') ?></p>
      <h1><?= bi('From student to developer, one step at a time.', 'ពីសិស្សទៅជាអ្នកអភិវឌ្ឍន៍ ជំហានម្តងមួយៗ។') ?></h1>
      <p class="lede">
        <span lang="en">I'm <strong><?= e($profile['nickname']) ?></strong> (<?= e($profile['name']) ?>). I started in high school, studied Software Engineering at Beltei International University, and now work as an application developer at First Cambodia with <strong>.NET, Report Builder and Power BI</strong>. I'm still early in my career, and I learn something new every day.</span>
        <span lang="km">ខ្ញុំគឺ <strong><?= e($profile['nickname']) ?></strong> (<?= e($profile['name']) ?>)។ ខ្ញុំបានចាប់ផ្តើមនៅវិទ្យាល័យ បានសិក្សាវិស្វកម្មកម្មវិធីនៅសាកលវិទ្យាល័យអន្តរជាតិ Beltei ហើយឥឡូវនេះធ្វើការជាអ្នកអភិវឌ្ឍន៍កម្មវិធីនៅ First Cambodia ដោយប្រើ <strong>.NET, Report Builder និង Power BI</strong>។ ខ្ញុំនៅតែមានបទពិសោធន៍តិច ហើយរៀនអ្វីថ្មីរាល់ថ្ងៃ។</span>
      </p>
      <div class="actions">
        <a class="btn primary" href="#experience"><?= bi('See my journey', 'មើលដំណើររបស់ខ្ញុំ') ?></a>
        <a class="btn glass" href="#contact"><?= bi('Say hello', 'ទាក់ទងខ្ញុំ') ?></a>
      </div>
    </div>

    <figure class="code glass">
      <figcaption class="code-head">developer.py</figcaption>
      <pre><code><span class="k">class</span> <span class="c">Developer</span>:
    <span class="v">nickname</span> = <span class="s">"Star"</span>
    <span class="v">name</span> = <span class="s">"Morn Lyhour"</span>
    <span class="v">role</span> = <span class="s">".NET and backend"</span>
    <span class="v">stack</span> = [<span class="s">"Laravel"</span>, <span class="s">".NET"</span>, <span class="s">"Python"</span>]

    <span class="k">def</span> <span class="f">build_system</span>(<span class="v">self</span>):
        <span class="k">return</span> <span class="s">"Scalable and secure"</span>

<span class="v">dev</span> = <span class="c">Developer</span>()
<span class="f">print</span>(<span class="v">dev</span>.build_system())</code></pre>
    </figure>
  </div>
</section>
