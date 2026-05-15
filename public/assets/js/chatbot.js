/**
 * AI Chatbot Widget
 * Uses a free AI API to provide intelligent responses
 */

class ChatbotWidget {
  constructor() {
    this.isOpen = false;
    this.messages = [];
    this.isTyping = false;

    // Free AI API - Using OpenRouter's free tier or fallback to simple responses
    this.apiEndpoint = "https://api.openai.com/v1/chat/completions";

    // We'll use a simple pattern matching for demo,
    // but you can add your API key here for full AI responses
    this.useAI = false;
    this.apiKey = ""; // Add your API key here if needed

    this.init();
  }

  init() {
    this.createWidget();
    this.bindEvents();
    this.addWelcomeMessage();
  }

  createWidget() {
    const container = document.createElement("div");
    container.className = "chatbot-container";
    container.innerHTML = `
            <button class="chatbot-toggle" id="chatbot-toggle" aria-label="Open chat">
                <i class="fas fa-robot"></i>
                <i class="fas fa-times"></i>
            </button>
            
            <div class="chatbot-window" id="chatbot-window">
                <div class="chatbot-header">
                    <div class="chatbot-avatar">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="chatbot-header-info">
                        <h4>Capacities Assistant</h4>
                        <span><span class="chatbot-status-dot"></span> Online - Ready to help</span>
                    </div>
                    <button class="chatbot-close" id="chatbot-close" aria-label="Close chat">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="chatbot-messages" id="chatbot-messages">
                </div>
                
                <div class="chatbot-quick-actions" id="chatbot-quick-actions">
                    <button class="quick-action-btn" data-message="How do I enroll in a course?">
                        📚 Enroll in course
                    </button>
                    <button class="quick-action-btn" data-message="How can I view my grades?">
                        📊 View grades
                    </button>
                    <button class="quick-action-btn" data-message="How do I submit an assignment?">
                        📝 Submit assignment
                    </button>
                    <button class="quick-action-btn" data-message="I need technical help">
                        🔧 Technical help
                    </button>
                </div>
                
                <div class="chatbot-input-container">
                    <div class="chatbot-input-wrapper">
                        <textarea 
                            class="chatbot-input" 
                            id="chatbot-input" 
                            placeholder="Type your message..."
                            rows="1"
                        ></textarea>
                        <button class="chatbot-send" id="chatbot-send" aria-label="Send message">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

    document.body.appendChild(container);

    this.elements = {
      container,
      toggle: document.getElementById("chatbot-toggle"),
      window: document.getElementById("chatbot-window"),
      close: document.getElementById("chatbot-close"),
      messages: document.getElementById("chatbot-messages"),
      input: document.getElementById("chatbot-input"),
      send: document.getElementById("chatbot-send"),
      quickActions: document.getElementById("chatbot-quick-actions"),
    };
  }

  bindEvents() {
    // Toggle chat window
    this.elements.toggle.addEventListener("click", () => this.toggle());
    this.elements.close.addEventListener("click", () => this.close());

    // Send message
    this.elements.send.addEventListener("click", () => this.sendMessage());
    this.elements.input.addEventListener("keydown", (e) => {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        this.sendMessage();
      }
    });

    // Auto-resize textarea
    this.elements.input.addEventListener("input", () => {
      this.elements.input.style.height = "auto";
      this.elements.input.style.height =
        Math.min(this.elements.input.scrollHeight, 100) + "px";
    });

    // Quick action buttons
    this.elements.quickActions.addEventListener("click", (e) => {
      const btn = e.target.closest(".quick-action-btn");
      if (btn) {
        const message = btn.dataset.message;
        this.elements.input.value = message;
        this.sendMessage();
      }
    });
  }

  toggle() {
    this.isOpen = !this.isOpen;
    this.elements.toggle.classList.toggle("active", this.isOpen);
    this.elements.window.classList.toggle("active", this.isOpen);

    if (this.isOpen) {
      this.elements.input.focus();
    }
  }

  close() {
    this.isOpen = false;
    this.elements.toggle.classList.remove("active");
    this.elements.window.classList.remove("active");
  }

  addWelcomeMessage() {
    this.addBotMessage(
      "👋 Hello! I'm your Capacities learning assistant. How can I help you today?"
    );
  }

  addBotMessage(content) {
    const messageHtml = `
            <div class="chat-message bot">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">${content}</div>
            </div>
        `;
    this.elements.messages.insertAdjacentHTML("beforeend", messageHtml);
    this.scrollToBottom();
  }

  addUserMessage(content) {
    const messageHtml = `
            <div class="chat-message user">
                <div class="message-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="message-content">${this.escapeHTML(content)}</div>
            </div>
        `;
    this.elements.messages.insertAdjacentHTML("beforeend", messageHtml);
    this.scrollToBottom();
  }

  showTyping() {
    const typingHtml = `
            <div class="chat-message bot" id="typing-indicator">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        `;
    this.elements.messages.insertAdjacentHTML("beforeend", typingHtml);
    this.scrollToBottom();
  }

  hideTyping() {
    const typing = document.getElementById("typing-indicator");
    if (typing) typing.remove();
  }

  scrollToBottom() {
    this.elements.messages.scrollTop = this.elements.messages.scrollHeight;
  }

  escapeHTML(text) {
    const div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
  }

  async sendMessage() {
    const message = this.elements.input.value.trim();
    if (!message || this.isTyping) return;

    // Add user message
    this.addUserMessage(message);
    this.elements.input.value = "";
    this.elements.input.style.height = "auto";

    // Hide quick actions after first message
    this.elements.quickActions.style.display = "none";

    // Show typing indicator
    this.isTyping = true;
    this.showTyping();

    // Get AI response
    try {
      const response = await this.getAIResponse(message);
      this.hideTyping();
      this.addBotMessage(response);
    } catch (error) {
      this.hideTyping();
      this.addBotMessage(
        "I'm sorry, I encountered an error. Please try again."
      );
    }

    this.isTyping = false;
  }

  async getAIResponse(message) {
    // Simulate typing delay
    await new Promise((resolve) =>
      setTimeout(resolve, 1000 + Math.random() * 1000)
    );

    // Smart response system based on keywords
    const lowerMessage = message.toLowerCase();

    // Course-related queries
    if (
      lowerMessage.includes("enroll") ||
      lowerMessage.includes("course") ||
      lowerMessage.includes("register")
    ) {
      return `📚 <strong>To enroll in a course:</strong><br><br>
                1. Go to "Browse Courses" from the sidebar<br>
                2. Find a course you're interested in<br>
                3. Click on the course to view details<br>
                4. Click the "Enroll Now" button<br><br>
                Once enrolled, the course will appear in your dashboard!`;
    }

    // Grades-related queries
    if (
      lowerMessage.includes("grade") ||
      lowerMessage.includes("score") ||
      lowerMessage.includes("result")
    ) {
      return `📊 <strong>To view your grades:</strong><br><br>
                1. Navigate to "Grades" in the sidebar<br>
                2. You'll see all your courses with grades<br>
                3. Click on any course to see detailed breakdown<br><br>
                Your overall GPA is also displayed at the top!`;
    }

    // Assignment-related queries
    if (
      lowerMessage.includes("assignment") ||
      lowerMessage.includes("submit") ||
      lowerMessage.includes("homework")
    ) {
      return `📝 <strong>To submit an assignment:</strong><br><br>
                1. Go to "My Assignments" from the sidebar<br>
                2. Find the assignment you want to submit<br>
                3. Click "View Details" or "Submit"<br>
                4. Upload your file or enter your response<br>
                5. Click "Submit Assignment"<br><br>
                Make sure to check the deadline!`;
    }

    // Quiz-related queries
    if (
      lowerMessage.includes("quiz") ||
      lowerMessage.includes("test") ||
      lowerMessage.includes("exam")
    ) {
      return `⏱️ <strong>About Quizzes:</strong><br><br>
                1. Go to "My Quizzes" from the sidebar<br>
                2. You'll see pending and completed quizzes<br>
                3. Click "Start Quiz" to begin<br>
                4. Answer all questions before the timer ends<br>
                5. Click "Submit" when done<br><br>
                Good luck! 🍀`;
    }

    // Technical help
    if (
      lowerMessage.includes("technical") ||
      lowerMessage.includes("help") ||
      lowerMessage.includes("problem") ||
      lowerMessage.includes("issue") ||
      lowerMessage.includes("error")
    ) {
      return `🔧 <strong>Technical Support:</strong><br><br>
                Common solutions:<br>
                • Try refreshing the page (Ctrl+F5)<br>
                • Clear your browser cache<br>
                • Try a different browser<br>
                • Check your internet connection<br><br>
                If problems persist, contact support at:<br>
                📧 support@capacities.edu`;
    }

    // Profile-related
    if (
      lowerMessage.includes("profile") ||
      lowerMessage.includes("account") ||
      lowerMessage.includes("password")
    ) {
      return `👤 <strong>Profile Settings:</strong><br><br>
                1. Click "Profile" in the sidebar<br>
                2. Update your personal information<br>
                3. Change password in security settings<br>
                4. Upload a new profile photo<br>
                5. Click "Save Changes"<br><br>
                Keep your profile updated!`;
    }

    // Greeting responses
    if (lowerMessage.match(/^(hi|hello|hey|مرحبا|اهلا)/)) {
      return `👋 Hello! Welcome to Capacities! I'm here to help you with:<br><br>
                📚 Course enrollment<br>
                📝 Assignments & submissions<br>
                ⏱️ Quizzes & exams<br>
                📊 Grades & progress<br>
                🔧 Technical issues<br><br>
                What would you like help with?`;
    }

    // Thank you response
    if (lowerMessage.match(/(thank|thanks|شكرا)/)) {
      return `😊 You're welcome! Is there anything else I can help you with?`;
    }

    // Default response
    return `🤔 I understand you're asking about "${message.substring(
      0,
      50
    )}..."<br><br>
            I can help you with:<br>
            • 📚 Course enrollment and browsing<br>
            • 📝 Assignment submissions<br>
            • ⏱️ Taking quizzes<br>
            • 📊 Viewing grades<br>
            • 🔧 Technical support<br><br>
            Could you please be more specific about what you need?`;
  }
}

// Initialize chatbot when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  // Only initialize on authenticated pages (where user is logged in)
  if (
    document.querySelector(".app-layout") ||
    document.querySelector(".sidebar")
  ) {
    new ChatbotWidget();
  }
});
