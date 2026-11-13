<section class="hero" id="top">
  <div class="wrap">
    <div>
      <!-- <p class="badge glass">= bi('From learning to building, one solution at a time.', 'ពីការរៀនសូត្រដល់ការបង្កើតឡើង ដំណោះស្រាយម្តងមួយៗ។') ?></p> -->
      <h1><?= bi('Building solutions, one query and report at a time.', 'បង្កើតដំណោះស្រាយ តាមរយៈសំណួរទិន្នន័យ និងរបាយការណ៍។') ?></h1>
      <p class="lede">
        <span lang="en">I'm <strong><?= e($profile['nickname']) ?></strong> (<?= e($profile['name']) ?>), a Software Engineering graduate and Application Developer at First Cambodia. I work with <strong>T-SQL, Stored Procedures, Report Builder, and Power BI</strong>, developing Core Banking reports and supporting customers with their reporting needs. Passionate about problem-solving, technology, and continuous growth.</span>
        <span lang="km">ខ្ញុំគឺ <strong><?= e($profile['nickname']) ?></strong> (<?= e($profile['name']) ?>) ជានិស្សិតបញ្ចប់ថ្នាក់បរិញ្ញាបត្រវិស្វកម្មសូហ្វវែរ និងជាអ្នកអភិវឌ្ឍន៍កម្មវិធីនៅ First Cambodia។ ខ្ញុំធ្វើការជាមួយ <strong>T-SQL, Stored Procedures, Report Builder និង Power BI</strong> ដោយអភិវឌ្ឍរបាយការណ៍ប្រព័ន្ធធនាគារស្នូល និងគាំទ្រអតិថិជនលើតម្រូវការរបាយការណ៍របស់ពួកគេ។ មានចំណង់ចំណូលចិត្តខ្លាំងលើការដោះស្រាយបញ្ហា បច្ចេកវិទ្យា និងការអភិវឌ្ឍខ្លួនឥតឈប់ឈរ។</span>
      </p>
      <div class="actions">
        <a class="btn primary" href="#experience"><?= bi('See my journey', 'មើលដំណើររបស់ខ្ញុំ') ?></a>
        <a class="btn glass" href="#contact"><?= bi('Say hello', 'ទាក់ទងខ្ញុំ') ?></a>
      </div>
    </div>

    <figure class="code glass">
      <figcaption class="code-head">developer.sql</figcaption>
      <pre><code><span class="k">INSERT INTO</span> Developer
<span class="k">VALUES</span> (
    <span class="s">'Morn Lyhour'</span>,
    <span class="s">'Application Developer'</span>,
    <span class="s">'T-SQL, Stored Procedures, Report Builder, Power BI'</span>
);

<span class="k">CREATE PROCEDURE</span> <span class="f">BuildSolutions</span>
<span class="k">AS</span>
<span class="k">BEGIN</span>
    <span class="k">SELECT</span>
        <span class="s">'Core Banking Reports'</span> <span class="k">AS</span> Focus,
        <span class="s">'Problem Solving'</span> <span class="k">AS</span> Mindset,
        <span class="s">'Continuous Learning'</span> <span class="k">AS</span> Goal;
<span class="k">END</span>;

<span class="k">EXEC</span> BuildSolutions;</code></pre>
    </figure>
  </div>
</section>