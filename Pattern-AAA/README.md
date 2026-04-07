---
marp: true
theme: default
paginate: true
backgroundColor: #09090b
color: #fafafa
style: |
  section {
    font-family: 'JetBrains Mono', monospace;
    font-size: 24px;
    border: 1px solid #27272a;
    padding: 60px 80px;
  }
  h1 { color: #f4f4f5; font-size: 2.2em; margin-top: 80px; }
  h2 { color: #3b82f6; font-size: 1.8em; border-bottom: 1px solid #27272a; padding-bottom: 10px; }
  h3 { color: #a1a1aa; }
  code { background: #18181b; color: #60a5fa; border: 1px solid #27272a; border-radius: 6px; }
  blockquote { background: #18181b; border-left: 4px solid #3b82f6; color: #d1d5db; padding: 10px 20px; }
  
  .logo-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: absolute;
    top: 30px;   
    left: 60px;
    right: 60px;
  }
  .logo-header img {
  
  height: 110px;  }
  
  .dt-card {
    background: #18181b;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #27272a;
    border-top: 4px solid #3b82f6;
    margin-top: 20px;
  }
  
  .highlight { color: #3b82f6; font-weight: bold; }

---

<div class="logo-header">
  <img src="images/ofppt-logo.png"   alt="OFPPT">
  <img src="images/solicode_tanger.png" alt="Solicode">
</div>

# **Pattern AAA (Arrange-Act-Assert)**
### Standard de l'écriture des Tests

**Réalisé par :** <span class="highlight">Mehdi Bentaleb</span>  
**Encadré par :** <span class="highlight">M. ESSARRAJ Fouad</span>  
**Filière :** Full-Stack Web Developer

---

## 🧐 C'est quoi le Pattern AAA ?

Le pattern **AAA** est une convention d'organisation des tests unitaires qui divise le test en trois blocs logiques distincts.

<div class="dt-card">
  <h4>Les objectifs principaux :</h4>
  <ul>
    <li>Séparer la préparation de l'exécution.</li>
    <li>Améliorer la lisibilité du code.</li>
    <li>Faciliter le débogage (savoir exactement où ça fail).</li>
  </ul>
</div>

---

## 🛠️ 1. Arrange (Préparation)

C'est l'étape de configuration. On prépare tout ce qui est nécessaire pour le test.

- **Actions :** Initialisation des variables, création des Models (Factories), Configuration des Mocks.
- **Question :** *De quoi ai-je besoin pour exécuter ce test ?*

> [!NOTE]
> C'est généralement la partie la plus longue du test.

---

## ⚡ 2. Act (Action)

C'est l'étape où l'on appelle la méthode ou la fonctionnalité que l'on veut tester.

- **Actions :** Exécution d'une fonction, appel d'un endpoint API.
- **Règle :** Idéalement, cette étape ne doit contenir qu'**une seule ligne** de code.
- **Question :** *Quelle est l'action que je teste ?*

---

## ✅ 3. Assert (Vérification)

L'étape finale où l'on vérifie si le résultat obtenu correspond au résultat attendu.

- **Actions :** Vérification des statuts HTTP, vérification de la base de données, comparaison de valeurs.
- **Question :** *Est-ce que le comportement est correct ?*

---

## 🚀 Exemple concret : Laravel

<div style="font-size: 0.85em;">

```php
public function test_it_calculates_total_price_after_discount()
{
    // --- ARRANGE --- (N-wejdu l-khidma)
    $price = 100;         // l-taman l-asli
    $discount = 20;      // remise dyal 20%
    $cart = new Cart();  // n-initializiw l-objet

    // --- ACT --- (N-executiw l-logic)
    $finalPrice = $cart->applyDiscount($price, $discount);

    // --- ASSERT --- (N-verifyiw l-natija)
    // 100 - 20% khass t-3tina 80
    $this->assertEquals(80, $finalPrice);
}