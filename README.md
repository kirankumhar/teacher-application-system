# Teacher Application System

A Laravel-based web application developed as part of a **machine test**, simulating an online teacher recruitment portal with applicant and admin workflows.

---

## 🔐 Authentication & Roles
- Role-based authentication using Laravel Breeze
- Roles:
  - **Applicant**
  - **Admin**
- Email verification after signup
- Protected routes using `auth`, and `role` middleware

---

## 🧑‍🏫 Applicant Module
- New applicant registration with eligibility validation
- Step-by-step application process:
  - **Step 1:** Payment details with category-based fee (₹1000 / ₹500)
  - **Step 2:** Personal information & educational qualifications
  - **Step 3:** Document upload (Photo, Signature, Certificates, etc.)
  - **Step 4:** Final preview & submission
- Automatic age calculation with category-wise relaxation rules
- Division calculation based on marks
- Application step tracking
- **Acknowledgement number generation**
- **Acknowledgement PDF generation and download**

---

## 🧑‍💼 Admin Module
- Admin dashboard
- View **all applicants**
- Separate listings for:
  - Submitted applications
  - Approved applications
  - Rejected applications
- View complete applicant details (education, documents, payment)
- Approve / Reject submitted applications
- On approval:
  - **Registration number generation** (subject-based format)
  - Application status update
- Status badges for quick identification

---

## 📄 Registration Number Format


